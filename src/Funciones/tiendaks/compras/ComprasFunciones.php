<?php

namespace App\Funciones\tiendaks\compras;

use App\Entity\Compras\compras;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use App\Repository\Compras\comprasRepository;
use App\Repository\Compras\detallecompraRepository;
use App\Repository\Usuario\usuarioRepository;

class ComprasFunciones
{
    private $usuarioRepository;
    private $comprasRepository;
    private $detallecompraRepository;
    private $productoFunciones;

    public function setUsuarioRepository(usuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function setComprasRepository(comprasRepository $comprasRepository){
        $this->comprasRepository = $comprasRepository;
    }

    public function setDetalleCompraRepository(detallecompraRepository $detallecompraRepository){
        $this->detallecompraRepository = $detallecompraRepository;
    }

    public function setProductoFunciones(ProductoFunciones $productoFunciones){
        $this->productoFunciones = $productoFunciones;
    }

    public function obtenerComprasTodos(array $criterios = []){   
        $compras = [];
        if (isset($criterios['ParamsCompraList']['usuario_id'])) {
            $compras = $this->obtenerComprasListadoRegistradasPorIdUsuario($criterios['ParamsCompraList']['usuario_id']);
        }
        return $this->convertirComprasAArrayLista($compras);
    }

    private function obtenerComprasListadoRegistradasPorIdUsuario(int $usuario_id){
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => $usuario_id,
        ]);
        $compras = $this->comprasRepository->findBy([
            'cliente' => $usuario,
        ]);
        return $compras;
    }

    private function convertirComprasAArrayLista(array $compras){
        $comprasListado = [];
        foreach ($compras as $compras_u) {
            $comprasListado[] = $this->convertirComprasAArray($compras_u);
        }
        return $comprasListado;
    }

    private function convertirComprasAArray(compras $compras){
        $detallecompra = $compras->getDetallecompras();
        $detallecompraArr = [];
        foreach ($detallecompra as $articulo) {
            $articuloArr = [
                'id' => $articulo->getId(),
                'dcm_cantidad' => $articulo->getDcmCantidad(),
                'dcm_importe' => $articulo->getDcmImporte(),
                'dcm_estado' => $articulo->getDcmEstado(),
                'producto' => $this->productoFunciones->convertirProductoAArray($articulo->getProducto())
            ];
            array_push($detallecompraArr, $articuloArr);
        }
        return [
            'id' => $compras->getId(),
            'cm_cantidadtotal' => $compras->getCmCantidadtotal(),
            'cm_importetotal' => $compras->getCmImportetotal(),
            'cm_fechacompra' => $compras->getCmFechacompra(),
            'detallecompras' => $detallecompraArr,
        ];
    }
}