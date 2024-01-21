<?php

namespace App\Funciones\tiendaks\carrito;

use App\Entity\Carrito\carrito;
use App\Entity\Usuario\usuario;
use App\Entity\Producto\producto;
use App\Entity\Carrito\detallecarrito;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\Carrito\carritoRepository;
use App\Repository\Usuario\usuarioRepository;
use App\Repository\Producto\productoRepository;
use App\Funciones\tiendaks\usuario\UsuarioFunciones;
use App\Repository\Carrito\detallecarritoRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class CarritoFunciones
{

    private $detallecarritoRepository;
    private $entityManager;
    private $usuario;
    private $funcionesproducto;
    

    public function __construct(ProductoFunciones $productoFunciones, UsuarioFunciones $usuarioFunciones, detallecarritoRepository $detallecarritoRepository,EntityManagerInterface $entityManager)
    {
        $this->detallecarritoRepository = $detallecarritoRepository;
        $this->usuario = $usuarioFunciones->obtenerUsuario();
        $this->entityManager = $entityManager;
        $this->funcionesproducto = $productoFunciones;
    }

        public function agregarProducto(int $idproducto, int $cantidad)
        {
    
        $usuario = $this->usuario;
        
        if($usuario === null){
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para proceder con el proceso'];
        }else{
            $producto = $this->funcionesproducto->verProducto($idproducto);
            if ($producto->getPrStock() < $cantidad) {
                return ['success' => false, 'message' => 'El producto actualmente no está disponible.'];
            } else {
                
                if ($usuario->getCarrito() == null) {  
                    $carrito = new carrito();
                    $detallecarrito = new detallecarrito();       
                    return $this->operacionAgregarACarrito(1, $usuario,$carrito,$detallecarrito,$producto,$cantidad);
                } else {
                    $carrito = $usuario->getCarrito();
                    $existe = null;
                    $detalles = $carrito->getDetallescarrito();
                    foreach ($detalles as $detalle) {
                        if ($detalle->getProducto() == $producto) {
                            return $this->operacionAgregarACarrito(2, $usuario,$carrito,$detalle,$producto,$cantidad);
                            $existe = true;
                            break;
                        }
                    }

                    if ($existe == null) {
                        $detallecarrito = new detallecarrito();
                        return $this->operacionAgregarACarrito(3, $usuario,$carrito,$detallecarrito,$producto,$cantidad);
                    }
                    
                }
            }
        }

        
    }


    private function operacionAgregarACarrito(int $tipo,usuario $usuario, Carrito $carrito,detallecarrito $detallecarrito, Producto $producto, int $cantidad)
    {
        $importe = $cantidad * $producto->getPrPrecio();
        $stockfinal = $producto->getPrStock() - $cantidad;
        if($tipo == 1){
            $carrito->setCCantidadtotal($cantidad);
            $carrito->setCImportetotal($importe);
            $carrito->setUsuario($usuario);
        } else{
            $carrito->setCCantidadtotal($carrito->getCCantidadtotal() + $cantidad);
            $carrito->setCImportetotal($carrito->getCImportetotal() + $importe);
        }
        if($tipo == 1 || $tipo == 3){
            $detallecarrito->setCarrito($carrito);
            $detallecarrito->setProducto($producto);
            $detallecarrito->setDcCantidad($cantidad);
            $detallecarrito->setDcImporte($importe);
            $carrito->addDetallescarrito($detallecarrito);
        }else{
            $detallecarrito->setDcCantidad($detallecarrito->getDcCantidad()+$cantidad);
            $detallecarrito->setDcImporte($detallecarrito->getDcImporte() + $importe);
        }   
        
        
        $producto->setPrStock($stockfinal);

        if($tipo == 1){
            $this->entityManager->persist($carrito);
        }

        if($tipo == 1 || $tipo == 3){
            $this->entityManager->persist($detallecarrito);
        }
        $this->entityManager->flush();
        $carritoVisualizado = $this->especificarDatos($carrito,$carrito->getDetallescarrito());
        return [
            'success' => true,
            'message' => 'Producto agregado al carrito exitosamente.',
            'carrito' => $carritoVisualizado['carrito'],
            'detallescarrito' => $carritoVisualizado['detallescarrito'],
        ];
    }

    public function modificarProducto(int $detallecarrito, int $cantidad)
    {
        $usuario = $this->usuario;
        if ($usuario === null) {
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para modificar la cantidad'];
        } else {
            $carrito = $usuario->getCarrito();
            $detallecarrito = $this->detallecarritoRepository->findOneBy([
                'id' => $detallecarrito
            ]);
            return $this->operacionModificarCarrito($carrito,$detallecarrito,$cantidad);
        }
    }

    public function visualizarCarrito()
    {

        $usuario = $this->usuario;
        if ($usuario === null) {
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para ver el resumen del carrito'];
        } else {
            $carrito = $usuario->getCarrito();
            if ($carrito === null || $carrito->getDetallescarrito()->isEmpty()) {
                return ['success' => true, 'message' => 'El carrito está vacío'];
            } else {
                
                // $resumen = [];
    
                // foreach ($detalles as $detalle) {
                //     $producto = $detalle->getProducto();
                //     $resumen[] = [
                //         'producto_id' => $producto->getId(),
                //         'producto_nombre' => $producto->getPrNombre(),
                //         'cantidad' => $detalle->getDcCantidad(),
                //         'importe' => $detalle->getDcImporte()
                //     ];
                // }
    
                // return [
                //     'success' => true,
                //     'message' => 'Resumen del carrito obtenido correctamente',
                //     'resumen_carrito' => $resumen
                // ];
                $detallescarrito = $carrito->getDetallescarrito();
                return $this->especificarDatos($carrito,$detallescarrito);
            }
        }
    }    

    public function eliminarProducto(int $detallecarrito)
    {
        $usuario = $this->usuario;
    
        if ($usuario === null) {
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para proceder con el proceso'];
        } else {
            $carrito = $usuario->getCarrito();
            $detallecarrito = $this->detallecarritoRepository->findOneBy([
                'id' => $detallecarrito
            ]);
            return $this->operacionModificarCarrito($carrito,$detallecarrito,0);
        }
    }    

    private function operacionModificarCarrito(Carrito $carrito, Detallecarrito $detallecarrito, int $cantidad)
    {
        $producto = $detallecarrito->getProducto();
        $difcantidad = $cantidad - $detallecarrito->getDcCantidad();
        $difprecio = $producto->getPrPrecio() * $difcantidad;
        if($difcantidad > $producto->getPrStock()){
            return [
                'success' => false,
                'message' => 'La cantidad supera el de los productos disponibles.',
                'carrito' => $this->visualizarCarrito()['carrito'],
                'detallescarrito' => $this->visualizarCarrito()['detallescarrito'],
            ];
        }
        if($difcantidad == 0){
            return $this->visualizarCarrito();
        }
        $carrito->setCCantidadtotal($carrito->getCCantidadtotal() + $difcantidad);
        $carrito->setCImportetotal($carrito->getCImportetotal() + $difprecio);
        $producto->setPrStock($producto->getPrStock() - $difcantidad);
        $detallecarrito->setDcImporte($producto->getPrPrecio() * $cantidad);
        $detallecarrito->setDcCantidad($cantidad);

        if ($detallecarrito->getDcCantidad() <= 0) {
            $carrito->removeDetallescarrito($detallecarrito);
            $this->entityManager->flush();
            $carritoVisualizado = $this->visualizarCarrito();
            $response = [
                'success' => true,
                'message' => 'Producto eliminado del carrito exitosamente.',
            ];

            if ($carrito->getDetallescarrito()->isEmpty()) {
                $response['estado'] = 'El carrito está vacío';
                $response['carrito'] = [
                    'id' => $carrito->getId(),
                    'cImportetotal' => $carrito->getCImportetotal()
                ];

            } else {
                $response['carrito'] = $carritoVisualizado['carrito'];
                $response['detallescarrito'] = $carritoVisualizado['detallescarrito'];
            }

            return $response;
        }

        $this->entityManager->flush();
        return [
            'success' => true,
            'message' => 'Cantidad modificada exitosamente',
            'carrito' => $this->visualizarCarrito()['carrito'],
            'detallescarrito' => $this->visualizarCarrito()['detallescarrito'],
        ];
    }
    
    private function especificarDatos(carrito $carrito, Collection $detallescarrito){
        $carritoespecificado = [
            'id' => $carrito->getId(),
            'cImportetotal' => $carrito->getCImportetotal()
        ];
    
        $detallescarritoespecificado = [];
    
        foreach ($detallescarrito as $detallecarrito) {
            $producto = $detallecarrito->getProducto();
            $detallescarritoespecificado[] = [
                'id' => $detallecarrito->getId(),
                'prNombre' => $producto->getPrNombre(),
                'prDescripcion' => $producto->getPrDescripcion(),
                'prPrecio' => $producto->getPrPrecio(),
                'prStock' => $producto->getPrStock(),
                'prImagenes' => json_decode($producto->getPrImagenes(), true),
                'dcCantidad' => $detallecarrito->getDcCantidad(),
                'dcImporte' => $detallecarrito->getDcImporte(),
            ];
        }
    
        return [
            'carrito' => $carritoespecificado,
            'detallescarrito' => $detallescarritoespecificado
        ];
    }
}