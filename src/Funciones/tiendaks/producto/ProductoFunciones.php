<?php

namespace App\Funciones\tiendaks\producto;

use App\Entity\Producto\producto;
use App\Repository\Producto\productoRepository;
use App\Funciones\tiendaks\producto\ProductoTestFunciones;
use App\Repository\Usuario\usuarioRepository;
use Exception;

class ProductoFunciones 
{
    private $productoRepository;
    private $productoTestFunciones;
    private $usuarioRepository;

    public function setProductoRepository(productoRepository $productoRepository){
        $this->productoRepository = $productoRepository;
    }

    public function setProductoTestFunciones(ProductoTestFunciones $productoTestFunciones){
        $this->productoTestFunciones = $productoTestFunciones;
    }

    public function setUsuarioRepository(usuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function obtenerProductoTodosOLlenarSiVacio(array $criterios = []){
        $productos = [];

        if(false === $this->validarProductoExistente()){
            $this->productoTestFunciones->registrarProductoDesdeAPILista();
        }
        
        // Parametros para el listado de productos
        if(empty($criterios) || empty($criterios['paramsProdList'])){
            $productos = $this->obtenerProductoTodos();
        } elseif (isset($criterios['paramsProdList']['id'])) {
            $producto = $this->obtenerProductoPorId($criterios['paramsProdList']['id']);
            if(!(is_null($producto))){
                array_push($productos, $producto);
            }
        } elseif (isset($criterios['paramsProdList']['busqueda'])) {
            $productos = $this->obtenerProductoBusquedaGeneral($criterios['paramsProdList']['busqueda']);
        } elseif (isset($criterios['paramsProdList']['usuario_id'])) {
            $productos = $this->obtenerProductoListadoRegistradoPorIdUsuario($criterios['paramsProdList']['usuario_id']);
        }

        // Opciones de ordenamiento para el listado de productos
        if (isset($criterios['optionsOrdenProdList']['categorias'])){
            $productos = $this->ordenarProductoListadoPorArrayCategorias($criterios['optionsOrdenProdList']['categorias'], $productos);
        }

        if (isset($criterios['optionsOrdenProdList']['precio']['precio_inicio']) && isset($criterios['optionsOrdenProdList']['precio']['precio_fin'])){
            $productos = $this->ordenarProductoListadoPorRangoDePrecio($criterios['optionsOrdenProdList']['precio']['precio_inicio'], $criterios['optionsOrdenProdList']['precio']['precio_fin'], $productos);
        }

        if (isset($criterios['optionsOrdenProdList']['stock'])){
            if ('si' === $criterios['optionsOrdenProdList']['stock']){
                $productos = $this->ordenarProductoListadoConStockPositivo($productos);
            }
        }

        if (isset($criterios['optionsOrdenProdList']['precio']['direccion'])){
            $productos = $this->ordenarProductoListadoPorPrecioConDireccion($criterios['optionsOrdenProdList']['precio']['direccion'], $productos);
        }
        
        if(isset($criterios['optionsOrdenProdList']['pagina']) && isset($criterios['optionsOrdenProdList']['cantidad_productos'])){
            $productos = $this->ordenarProductosListadoPorPaginacion($criterios['optionsOrdenProdList']['pagina'], $criterios['optionsOrdenProdList']['cantidad_productos'], $productos);
        }

        return $this->convertirProductoAArrayLista($productos);
    }

    public function validarProductoExistente(){
        return !(empty($this->obtenerProductoTodos()));
    }

    private function obtenerProductoTodos(){
        $productos = $this->productoRepository->findAll();
        return $productos;
    }

    private function convertirProductoAArrayLista(array $productos) {
        $productoslistado = [];
        foreach ($productos as $producto) {
            $productoslistado[] = $this->convertirProductoAArray($producto);
        }
        return $productoslistado;
    }

    public function convertirProductoAArray(producto $producto) {
        $precio = $producto->getPrPrecio();
        $descuento = $this->obtenerProductoDescuento($producto);
        $valoracionData = $this->obtenerProductoValoracion($producto);
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

    private function obtenerProductoDescuento(producto $producto){
        if($producto->getDescuento() === null){
            $descuento = 0;
        } else {
            $descuento = $producto->getDescuento()->getDsValor();
        }
        return $descuento;
    }

    private function obtenerProductoValoracion(producto $producto){
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

    private function obtenerProductoPorId(int $id){
        $producto = $this->productoRepository->findOneBy([
            'id' => $id
        ]);
        return $producto;
    }

    private function obtenerProductoBusquedaGeneral($busqueda){
        return $this->productoRepository->buscarProducto($busqueda);
    }

    private function obtenerProductoListadoRegistradoPorIdUsuario(int $usuario_id){
        $usuario = $this->usuarioRepository->findOneBy(['id' => $usuario_id,]);
        $productos = $this->productoRepository->findBy(['usuario' => $usuario,]);
        return $productos;
    }

    private function ordenarProductosListadoPorPaginacion(int $pagina, int $cantidad_productos, array $productos){
        $inicio = $cantidad_productos * ($pagina - 1);
        $extracto = [];

        try {
            $extracto = array_slice($productos, $inicio, $cantidad_productos);
        } catch (Exception $e) {
            //No hecer nada
        }

        return $extracto;
    }

    private function ordenarProductoListadoPorArrayCategorias(array $categorias, array $productos){
        try {
            $extracto = array_filter($productos, 
                function($articulo) use ($categorias){
                    if(!in_array($articulo->getPrCategoria(), $categorias)){
                        return false;
                    }
                    return true;
                }
            );
        } catch (Exception $e) {
            //No hecer nada
        }

        return $extracto;
    }

    private function ordenarProductoListadoConStockPositivo(array $productos){
        try {
            $extracto = array_filter($productos, 
                function($articulo) {
                    if($articulo->getPrStock() <= 0){
                        return false;
                    }
                    return true;
                }
            );
        } catch (Exception $e) {
            //No hecer nada
        }
        return $extracto;
    }

    private function ordenarProductoListadoPorRangoDePrecio(float $precio_inicio, float $precio_fin, array $productos){
        try {
            $extracto = array_filter($productos, 
                function($articulo) use ($precio_inicio, $precio_fin){
                    if($articulo->getPrPrecio() > $precio_fin || $articulo->getPrPrecio() < $precio_inicio){
                        return false;
                    }
                    return true;
                }
            );
        } catch (Exception $e) {
            //No hecer nada
        }
        return $extracto;
    }

    private function ordenarProductoListadoPorPrecioConDireccion(string $direccion, array $productos){
        if ($direccion === 'ascendente'){
                $productos = $this->ordenarProductoListadoPorPrecioAscendente($productos);
        } elseif ($direccion === 'descendente') {
                $productos = $this->ordenarProductoListadoPorPrecioDescendente($productos);
        }
        
        return $productos;
    }

    private function ordenarProductoListadoPorPrecioAscendente(array $productos){
        $longitud = count($productos);
        $extracto = array_values($productos);
        try {
            for ($i=0; $i < $longitud; $i++) { 
                for ($j=0; $j < $longitud - 1; $j++) { 
                    if($extracto[$j]->getPrPrecio() > $extracto[$j + 1]->getPrPrecio()){
                        $temporal = $extracto[$j];
                        $extracto[$j] = $extracto[$j + 1];
                        $extracto[$j + 1] = $temporal;
                    }
                }
            }
        } catch (Exception $e) {
            //No hecer nada
        }
        return $extracto;
    }

    private function ordenarProductoListadoPorPrecioDescendente(array $productos){
        $longitud = count($productos);
        $extracto = array_values($productos);
        try {
            for ($i=0; $i < $longitud; $i++) { 
                for ($j=0; $j < $longitud - 1; $j++) { 
                    if($extracto[$j]->getPrPrecio() < $extracto[$j + 1]->getPrPrecio()){
                        $temporal = $extracto[$j];
                        $extracto[$j] = $extracto[$j + 1];
                        $extracto[$j + 1] = $temporal;
                    }
                }
            }
        } catch (Exception $e) {
           //No hecer nada
        }
        return $extracto;
    }
}