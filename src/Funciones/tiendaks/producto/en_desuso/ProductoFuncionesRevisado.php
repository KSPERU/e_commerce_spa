<?php

namespace App\Funciones\tiendaks\producto\en_desuso;

use App\Entity\Producto\producto;
use App\Entity\Usuario\usuario;
use App\Repository\Producto\productoRepository;
use App\Repository\Usuario\usuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Exception;

// Se recomienda no elimnar ninguna funcion de este archivo  (￣＾￣). 
class ProductoFuncionesRevisado
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
    
    // ********************************************
    // Revisado (29/01/2024)
    // ********************************************

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

    public function obtenerProductosClasificados(string $categoria, string $atributo, string $modo, float $inicio, float $fin){
        $productos = $this->obtenerProductosProcesado();
        
        //1. Categorizemos
        $productos = $this->obtenerProductosCategorizados($categoria, $productos);
        //2. Ordenemos por atributo
        $productos = $this->obtenerProductosOrdenados($atributo, $modo, $productos);
        //3. Rango de precios aceptado
        $productos = $this->obtenerProductosEstimados($inicio, $fin, $productos);
        $productosespecificados = $this->especificarProductos($productos);
        return $productosespecificados;
    }

    public function obtenerProductosClasificadosStock(array $categorias, array $atributos, string $busqueda){
        $productos = $this->obtenerProductosProcesado();
        if($busqueda !== ""){
            $productos = $this->buscarProductoStock($busqueda);
        }
        $productos = $this->obtenerProductosCategorizadosArray($categorias, $productos);
        $productos = $this->ordenarProductosPorAtributo($atributos, $productos);
        // Limpieza de listado
        $productos = $this->obtenerProductosConStock($productos);
        $productos = $this->especificarProductos($productos);
        return $productos;
    }

    public function obtenerProductorPorUsuarioArray(int $usuario){
        return $this->especificarProductos($this->obtenerProductorPorUsuario($usuario));
    }

    public function obtenerProductosOrdenados(string $atributo, string $modo, array $productos){
        if ($atributo == 'precio') {
            if ($modo == 'menor'){
                $productos = $this->obtenerProductosOrdenadosPrecioMenor($productos);
            } elseif ($modo == 'mayor') {
                $productos = $this->obtenerProductosOrdenadosPrecioMayor($productos);
            }
        }
        return $productos;
    }

    public function obtenerProductosFiltradosOrdenados(string $atributo, string $modo){
        $productos = $this->obtenerProductosProcesado();
        //Ordenamiento de precio
        if ($atributo == 'precio') {
            if ($modo == 'menor'){
                $productos = $this->obtenerProductosOrdenadosPrecioMenor($productos);
            } elseif ($modo == 'mayor') {
                $productos = $this->obtenerProductosOrdenadosPrecioMayor($productos);
            }
        }
        return $productos;
    }

    public function ordenarProductosPorAtributo(array $atributos, array $productos){
        foreach ($atributos as $atributo) {
            if($atributo[0] == 'precio'){
                if ($atributo[1]== 'menor'){
                    $productos = $this->obtenerProductosOrdenadosPrecioMenor($productos);
                } elseif ($atributo[1] == 'mayor') {
                    $productos = $this->obtenerProductosOrdenadosPrecioMayor($productos);
                }
                $productos = $this->obtenerProductosEstimados($atributo[2], $atributo[3], $productos);
            }
        }
        return $productos;
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

    public function obtenerProductosFiltradosCategorizados(string $categoria){
        $productos = $this->obtenerProductosProcesado();
        $productos = $this->obtenerProductosCategorizados($categoria, $productos);
        return $productos;
    }

    public function obtenerProductosFiltradosCategorizadosConStock(string $categoria){
        $productos = $this->obtenerProductosProcesado();
        $productos = $this->obtenerProductosCategorizados($categoria, $productos);
        $productos = $this->obtenerProductosConStock($productos);
        return $productos;
    }

    public function obtenerProductosConStock(array $productos){
        try {
            $productos_aux = array_filter($productos, 
                function($articulo) {
                    if($articulo->getPrStock() == 0){
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

    public function obtenerProductosCategorizadosArray(array $categorias, array $productos){
        try {
            $productos_aux = array_filter($productos, 
                function($articulo) use ($categorias){
                    if(!in_array($articulo->getPrCategoria(), $categorias)){
                        return false;
                    }
                    return true;
                }
            );
            if(empty($productos_aux)){
                $productos_aux = $productos;
            }
        } catch (Exception $e) {
            //No hecer nada
        } 
        return $productos_aux;
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

    public function obtenerProductosProcesado(){
        //Si no se encuentran productos se cargaran productos de una API externa
        if($this->validarExistenciaProductos() === false){
            $this->registrarProductosTest();
        }
        $productos = $this->obtenerProductos();
        return $productos;
    }

    public function verProductoProcesado(int $id){
        $producto = $this->verProducto($id);
        if (null === $producto){
            $aux = $this->obtenerProductos();
            $producto = $aux[0];
        }

        $productoespecificado = $this->especificarProducto($producto);
        return $productoespecificado;
    }

    public function obtenerProductorPorUsuario(int $id){
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => $id,
        ]);
        $productos = $this->productoRepository->findBy([
            'usuario' => $usuario, 
        ]);
        return $productos;
    }

    public function buscarProducto($busqueda){
        if($this->validarExistenciaProductos() === false){
            $this->registrarProductosTest();
        }
        $producto = $this->productoRepository->buscarProducto($busqueda);
        $productoespecificado = $this->especificarProductos($producto);
        return $productoespecificado;
    }

    public function buscarProductoStock($busqueda){
        if($this->validarExistenciaProductos() === false){
            $this->registrarProductosTest();
        }
        $productos = $this->productoRepository->buscarProducto($busqueda);
        return $productos;
    }

    public function verProducto(int $id){
        $producto = $this->productoRepository->findOneBy([
            'id' => $id
        ]);
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

    public function obtenerProductos(){
        $productos = $this->productoRepository->findAll();
        return $productos;
    }

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
                $producto->setPrDescripcion($articulo['description']);
                $imagenes = json_encode($articulo['images']);
                $producto->setPrImagenes($imagenes);
                $producto->setPrStock($articulo['stock']);
                $producto->setPrPrecio($articulo['price']);
                $this->entityManagerInterface->persist($producto);
                $this->entityManagerInterface->flush();
            }
        } catch(Exception $e) {
            //No hacer nada
        }
    }

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

    private function especificarProductoBase(Producto $producto) {
        $precio = $producto->getPrPrecio();
        $descuento = $this->obtenerdescuentoproducto($producto);
        $valoracionData = $this->obtenervaloracionesproducto($producto);
        $valoracion = $valoracionData['valoracion'];
        $cantvaloraciones = $valoracionData['cantvaloraciones'];
    
        return [
            'id' => $producto->getId(),
            'pr_nombre' => $producto->getPrNombre(),
            'pr_descripcion' => $producto->getPrDescripcion(),
            'pr_categoria' => $producto->getPrCategoria(),
            'pr_imagenes' => json_decode($producto->getPrImagenes(), true),
            'pr_precio' => $precio,
            'pr_descuento' => $descuento,
            'pr_preciofinal' => $precio - $precio * $descuento,
            'valoracion' => $valoracion,
            'cantidadvaloracion' => $cantvaloraciones
        ];
    }
    
    public function especificarProductos(array $productos) {
        $productoslistado = [];
        foreach ($productos as $producto) {
            $productoslistado[] = $this->especificarProductoBase($producto);
        }
    
        return $productoslistado;
    }
    
    public function especificarProducto(Producto $producto) {
        return [$this->especificarProductoBase($producto)];
    }

    private function obtenerdescuentoproducto(Producto $producto){
        if($producto->getDescuento() == null){
            $descuento = 0;
        }else{
            $descuento = $producto->getDescuento()->getDsValor();
        }
        return $descuento;
    }

    private function obtenervaloracionesproducto(Producto $producto){
            $valoraciones = $producto->getValoraciones();
            $cantvaloraciones = count($valoraciones);
            $total = 0;
            foreach($valoraciones as $valoracion){
                $total = $total + $valoracion->getVlValor();
            }
            if ($cantvaloraciones == 0){
                $valoracion = 0;
            }else{
                $valoracion = intval($total/count($valoraciones));
            }
        return [
            'valoracion' => $valoracion,
            'cantvaloraciones' => $cantvaloraciones,
        ];
    }
}