<?php

namespace App\Funciones\tiendaks\producto;

use Exception;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use App\Entity\Producto\producto;
use App\Entity\Usuario\usuario;
use App\Repository\Usuario\usuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductoTestFunciones 
{
    private $usuarioRepository;
    private $entityManagerInterface;
    private $httpClientInterface;
    private $productoFunciones;

    public function setUsuarioRepository(UsuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function setEntityManagerInterface(EntityManagerInterface $entityManagerInterface){
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function setHttpClientInterface(HttpClientInterface $httpClientInterface){
        $this->httpClientInterface = $httpClientInterface;
    }

    public function setProductoFunciones(ProductoFunciones $productoFunciones){
        $this->productoFunciones = $productoFunciones;
    }

    public function registrarProductoDesdeAPILista(){
        if(false === $this->productoFunciones->validarProductoExistente()){
            $this->registrarUsuarioTest();
            $usuario = $this->obtenerUsuarioTest();
            try {
                $productos = $this->obtenerProductoDesdeAPIRemotaLista();
                foreach ($productos as $articulo) {
                    $producto = new producto();
                    $producto->setUsuario($usuario);
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
    }

    private function obtenerProductoDesdeAPIRemotaLista(){
        $url = "https://dummyjson.com/products";
        $respuesta = $this->httpClientInterface->request('GET', $url);
        $productos = $respuesta->toArray();
        return $productos['products'];
    }

    private function registrarUsuarioTest(){
        if($this->validarUsuarioTestExistente() === false){
            $usuario = new usuario();
            $usuario->setUCorreo('test@ksperu.com');
            $usuario->setRoles(['ROLE_USER']);
            $usuario->setPassword('$2y$13$gdOgA9lpoTuhf6AIPLejUOD1JA3.goF58Pxaf/4mJbEdbHxvXuxJS');
            $usuario->setUNombres('Test');
            $usuario->setUApepat('Test');
            $usuario->setUApemat('Test');
            $usuario->setUDni('87654321');
            $usuario->setUEstado(true);
            $this->entityManagerInterface->persist($usuario);
            $this->entityManagerInterface->flush();
        }
    }

    private function validarUsuarioTestExistente(){
        return !(is_null($this->obtenerUsuarioTest()));
    }

    private function obtenerUsuarioTest(){
        return $usuario = $this->usuarioRepository->findOneBy([
            'u_dni' => '87654321', 
        ]);
    }
}