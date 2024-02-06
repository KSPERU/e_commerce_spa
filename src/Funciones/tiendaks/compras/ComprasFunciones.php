<?php

namespace App\Funciones\tiendaks\compras;

use App\Entity\Compras\compras;
use App\Entity\Compras\detallecompra;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Compras\comprasRepository;
use App\Repository\Usuario\usuarioRepository;
use App\Repository\Compras\detallecompraRepository;
use App\Funciones\tiendaks\usuario\UsuarioFunciones;
use App\Funciones\tiendaks\producto\ProductoFunciones;

class ComprasFunciones
{
    private $usuarioRepository;
    private $comprasRepository;
    private $detallecompraRepository;
    private $productoFunciones;
    private $entityManager;
    private $usuario;

    public function __construct(UsuarioFunciones $usuarioFunciones,EntityManagerInterface $entityManager)
    {
        $this->usuario = $usuarioFunciones->obtenerUsuario();
        $this->entityManager = $entityManager;
    }

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
    public function comprarCarrito()
    {
        $usuario = $this->usuario;

        if ($usuario === null || $usuario->getCarrito() === null) {
            return [
                'success' => false,
                'message' => 'No hay carrito para realizar la compra.',
            ];
        }

        $carrito = $usuario->getCarrito();
        $detallesCarrito = $carrito->getDetallescarrito();

        if ($detallesCarrito->isEmpty()) {
            return [
                'success' => false,
                'message' => 'El carrito esta vacío, no hay productos para comprar.',
            ];
        }

        $compra = new compras();
        $compra->setCliente($usuario);
        $compra->setCmCantidadtotal($carrito->getCCantidadtotal());
        $compra->setCmImportetotal($carrito->getCImportetotal());
        $compra->setCmFechacompra(new \DateTime('now'));

        $this->entityManager->persist($compra);
        $this->entityManager->flush();

        foreach ($detallesCarrito as $detalleCarrito) {
            $detalleCompra = new detallecompra();
            $detalleCompra->setCompra($compra);
            $detalleCompra->setProducto($detalleCarrito->getProducto());
            $detalleCompra->setDcmCantidad($detalleCarrito->getDcCantidad());
            $detalleCompra->setDcmImporte($detalleCarrito->getDcImporte());
            $detalleCompra->setDcmEstado(0);
            $producto = $detalleCompra->getProducto();
            $producto->setPrStock($producto->getPrStock()-$detalleCarrito->getDcCantidad());

            $this->entityManager->persist($detalleCompra);
            $this->entityManager->remove($detalleCarrito);
        }

        $this->entityManager->remove($carrito);
        $this->entityManager->flush();

        return [
            'success' => true,
            'message' => 'Compra realizada con exito.',
        ];
    }
}