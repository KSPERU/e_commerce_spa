<?php

namespace App\Funciones\tiendaks\producto;

use App\Entity\Producto\producto;
use App\Entity\Usuario\usuario;
use App\Repository\Producto\productoRepository;
use App\Repository\Usuario\usuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Exception;

// Se recomienda no elimnar ninguna funcion de este archivo  (￣＾￣). 
class ProductoFunciones
{
    private $productoRepository;
    private $usuarioRepository;
    private $httpClientInterface;
    private $entityManagerInterface;

    public function __construct(productoRepository $productoRepository, usuarioRepository $usuarioRepository, HttpClientInterface $httpClientInterface, EntityManagerInterface $entityManagerInterface)
    {
        $this->productoRepository = $productoRepository;
        $this->httpClientInterface = $httpClientInterface;
        $this->usuarioRepository = $usuarioRepository;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    //Funciones Centrales

    public function obtenerProductos(){
        $productos = $this->productoRepository->findAll();
        return $productos;
    }

    public function verProducto(int $id){
        $producto = $this->productoRepository->findOneBy([
            'id' => $id
        ]);
        return $producto;
    }

    public function buscarProducto($busqueda){
        $producto = $this->productoRepository->buscarProducto($busqueda);
        return $producto;
    }

    // Funciones Procesadas

    public function verProductoProcesado(int $id){
        $producto = $this->verProducto($id);
        if (null === $producto){
            $aux = $this->obtenerProductos();
            $producto = $aux[0];
        }
        return $producto;
    }

    public function validarExistenciaProductos(){
        $existenciaProductos = true;
        //Validar array vacio
        if(empty($this->obtenerProductos())){
            $existenciaProductos = false;
        }
        return $existenciaProductos;
    }

    public function obtenerProductosProcesado(){
        //Si no se encuentran productos se cargaran productos de una API externa
        if($this->validarExistenciaProductos() === false){
            $this->registrarProductosTest();
        }
        $productos = $this->obtenerProductos();
        return $productos;
    }

    public function obtenerProductosFiltradosPaginados(int $pagina, int $cantidad){
        $productos = $this->obtenerProductosProcesado();
        $productos = $this->obtenerProductosPaginados($pagina, $cantidad, $productos);
        return $productos;
    }

    public function obtenerProductosPaginados(int $pagina, int $cantidad, array $productos){
        $inicio = $cantidad * ($pagina - 1);
        $productos_aux = [];
        try {
            $productos_aux = array_slice($productos, $inicio, $cantidad);
        } catch (Exception $e) {
            //No hecer nada
        }
        return $productos_aux;
    }

    public function obtenerProductosFiltradosCategorizados(string $categoria){
        $productos = $this->obtenerProductosProcesado();
        $productos = $this->obtenerProductosCategorizados($categoria, $productos);
        return $productos;
    }

    public function obtenerProductosCategorizados(string $categoria, array $productos){
        try {
            $productos_aux = array_filter($productos, 
                function($articulo) use ($categoria){
                    if($articulo->getPrCategoria() !== $categoria){
                        return false;
                    }
                    return true;
                }
            );
        } catch (Exception $e) {
            //No hecer nada
        }
        return $productos_aux;
    }

    public function obtenerProductosFiltradosEstimados(float $inicio, float $fin){
        $productos = $this->obtenerProductosProcesado();
        $productos = $this->obtenerProductosEstimados($inicio, $fin, $productos);
        return $productos;
    }

    public function obtenerProductosEstimados(float $inicio, float $fin, array $productos){
        // $fin > $articulo->getPrPrecio() $inicio > $articulo->getPrPrecio()
        try {
            $productos_aux = array_filter($productos, 
                function($articulo) use ($inicio, $fin){
                    if($articulo->getPrPrecio() > $fin || $articulo->getPrPrecio() < $inicio){
                        return false;
                    }
                    return true;
                }
            );
        } catch (Exception $e) {
            //No hecer nada
        }
        return $productos_aux;
    }

    public function obtenerProductosFiltradosOrdenados(string $categoria, string $modo){
        $productos = $this->obtenerProductosProcesado();
        //Ordenamiento de precio
        if ($categoria == 'precio') {
            if ($modo == 'menor'){
                $productos = $this->obtenerProductosOrdenadosPrecioMenor($productos);
            } elseif ($modo == 'mayor') {
                $productos = $this->obtenerProductosOrdenadosPrecioMayor($productos);
            }
        }
        return $productos;
    }

    public function obtenerProductosOrdenadosPrecioMenor(array $productos){
        $longitud = count($productos);
        $productos_aux = $productos;
        try {
            for ($i=0; $i < $longitud; $i++) { 
                for ($j=0; $j < $longitud - 1; $j++) { 
                    if($productos_aux[$j]->getPrPrecio() > $productos_aux[$j + 1]->getPrPrecio()){
                        $temporal = $productos_aux[$j];
                        $productos_aux[$j] = $productos_aux[$j + 1];
                        $productos_aux[$j + 1] = $temporal;
                    }
                }
            }
        } catch (Exception $e) {
            //No hecer nada
        }
        return $productos_aux;
    }

    public function obtenerProductosOrdenadosPrecioMayor(array $productos){
        $longitud = count($productos);
        $productos_aux = $productos;
        try {
            for ($i=0; $i < $longitud; $i++) { 
                for ($j=0; $j < $longitud - 1; $j++) { 
                    if($productos_aux[$j]->getPrPrecio() < $productos_aux[$j + 1]->getPrPrecio()){
                        $temporal = $productos_aux[$j];
                        $productos_aux[$j] = $productos_aux[$j + 1];
                        $productos_aux[$j + 1] = $temporal;
                    }
                }
            }
        } catch (Exception $e) {
            //No hecer nada
        }
        return $productos_aux;
    }

    //Funciones Test

    /// Funciones Test Procesadas

    public function validarUsuarioTest(){
        $existeUsuarioTest = true;
        //Validar usuario null
        if(null === $this->obtenerUsuarioTest()){
            $existeUsuarioTest = false;
        }
        return $existeUsuarioTest;
    }

    public function registrarProductosTest(){
        if($this->validarUsuarioTest() === false){
            $this->registrarUsuarioTest();
        }
        $usuarioTest = $this->obtenerUsuarioTest();

        try {
            $listado_productos = $this->obtenerProductosRemoto();
            foreach ($listado_productos as $articulo) {
                $producto = new producto();
                $producto->setUsuario($usuarioTest);
                $producto->setPrNombre($articulo['title']);
                $producto->setPrCategoria($articulo['category']);
                $producto->setPrStock($articulo['stock']);
                $producto->setPrPrecio($articulo['price']);
                $this->entityManagerInterface->persist($producto);
                $this->entityManagerInterface->flush();
            }
        } catch(Exception $e) {
            //No hacer nada
        }
    }

    /// Funciones Test Centrales

    public function obtenerProductosRemoto(){
        $url = "https://dummyjson.com/products";
        $respuesta = $this->httpClientInterface->request('GET', $url);
        $productos = $respuesta->toArray();
        return $productos['products'];
    }

    public function obtenerUsuarioTest(){
        $usuario = $this->usuarioRepository->findOneBy([
            'u_dni' => '87654321', 
        ]);
        return $usuario;
    }

    public function registrarUsuarioTest(){
        $usuarioTest = new usuario();
        $usuarioTest->setUCorreo('test@ksperu.com');
        $usuarioTest->setRoles(['ROLE_USER']);
        $usuarioTest->setPassword('$2y$13$gdOgA9lpoTuhf6AIPLejUOD1JA3.goF58Pxaf/4mJbEdbHxvXuxJS');
        $usuarioTest->setUNombres('Test');
        $usuarioTest->setUApepat('Test');
        $usuarioTest->setUApemat('Test');
        $usuarioTest->setUDni('87654321');
        $usuarioTest->setUEstado(true);
        $this->entityManagerInterface->persist($usuarioTest);
        $this->entityManagerInterface->flush();
    }
}