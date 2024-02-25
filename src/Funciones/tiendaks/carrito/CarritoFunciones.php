<?php

namespace App\Funciones\tiendaks\carrito;

use App\Entity\Carrito\carrito;
use App\Entity\Usuario\usuario;
use App\Entity\Producto\producto;
use App\Entity\Carrito\detallecarrito;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Funciones\tiendaks\usuario\UsuarioFunciones;
use App\Repository\Carrito\detallecarritoRepository;
use App\Funciones\tiendaks\producto\ProductoFunciones;

class CarritoFunciones
{
    private $detallecarritoRepository;
    private $entityManager;
    private $usuario;
    private $funcionesproducto;

    public function __construct(private RequestStack $requestStack,ProductoFunciones $productoFunciones, UsuarioFunciones $usuarioFunciones, detallecarritoRepository $detallecarritoRepository,EntityManagerInterface $entityManager)
    {
        $this->detallecarritoRepository = $detallecarritoRepository;
        $this->usuario = $usuarioFunciones->obtenerUsuario();
        $this->entityManager = $entityManager;
        $this->funcionesproducto = $productoFunciones;
    }

    public function agregarProducto(int $idproducto, int $cantidad){
        $operacion = $this->agregarProductoCasos($idproducto, $cantidad);
        if($operacion){
            $resultado = $this->visualizarCarrito();
            return [
                'success' => 'true',
                'carrito' => $resultado['carrito'],
                'detallescarrito' => $resultado['detallescarrito'],
            ];
        }
    }

    private function agregarProductoCasos(int $idproducto, int $cantidad){
    
        $usuario = $this->usuario;
        $producto = $this->funcionesproducto->obtenerProductoPorId($idproducto);
        if ($producto->getPrStock() < $cantidad) {
            return ['success' => false, 'message' => 'El producto actualmente no está disponible.'];
        } else {
            if($usuario === null){
                return $this->agregarProductoSesion($producto, $cantidad, $idproducto);
            }else{
                if ($usuario->getCarrito() == null) {  
                    $carrito = new carrito();
                    $detallecarrito = new detallecarrito();       
                    $operacion = $this->AgregarProductoOperacion(1, $usuario,$carrito,$detallecarrito,$producto,$cantidad);
                    if($operacion){
                        return true;
                    }
                } else {
                    $carrito = $usuario->getCarrito();
                    $existe = null;
                    $detalles = $carrito->getDetallescarrito();
                    foreach ($detalles as $detalle) {
                        if ($detalle->getProducto() == $producto) {
                            $operacion = $this->AgregarProductoOperacion(2, $usuario,$carrito,$detalle,$producto,$cantidad);
                            if($operacion){
                                $existe = true;
                                return true;
                                break;
                            }
                        
                        }
                    }

                    if ($existe == null) {
                        $detallecarrito = new detallecarrito();
                        $operacion = $this->AgregarProductoOperacion(3, $usuario,$carrito,$detallecarrito,$producto,$cantidad);
                        if($operacion){
                            return true;
                        }
                    }
                    
                }
            }
        }

        return false;
    }

    private function agregarProductoSesion(Producto $producto, int $cantidad, int $idproducto){
        
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);
        if (empty($carrito)){
            return $this->agregarProductoSesionOperacion(1,$cantidad,$producto);
        }else{
            $detallescarrito = $session->get('detallescarrito', []);
            if(empty($detallescarrito)){
                return $this->agregarProductoSesionOperacion(2,$cantidad,$producto); 
        }else{
            $importe = $cantidad*$producto->getPrPrecio();
            $existe = null;
            foreach ($detallescarrito as $key => $detalle) {
                if ($detalle['id_producto'] == $idproducto) {
                    $detallescarrito[$key]['dcCantidad'] += $cantidad;
                    $detallescarrito[$key]['dcImporte'] += $importe;
                    $existe = true;
                    break;
                }
            }
            if($existe)
            {
                    $carrito['cImportetotal'] += $importe;
                    $carrito['cCantidad'] += $cantidad;
                    $session->set('detallescarrito', $detallescarrito);
                    $session->set('carrito', $carrito);
                    return $this->visualizarCarritosession();
            }else{
                return $this->agregarProductoSesionOperacion(3,$cantidad,$producto); 
            }
                    
        }
    }

    }

    private function agregarProductoSesionOperacion(int $tipo,int $cantidad, Producto $producto){
        $importe = $cantidad * $producto->getPrPrecio();
        $session = $this->requestStack->getSession();
        
        if($tipo == 1){
            $carrito = [
                'cImportetotal' => $importe,
                'cCantidad' => $cantidad,
            ];
            $detalleCarrito = [
                [
                    'id' => 1,
                    'id_producto' => $producto->getId(),
                    'prNombre' => $producto->getPrNombre(),
                    'prDescripcion' => $producto->getPrDescripcion(),
                    'prPrecio' => $producto->getPrPrecio(),
                    'prImagenes' => json_decode($producto->getPrImagenes(), true),
                    'dcCantidad' => $cantidad,
                    'dcImporte' => $importe
                ],
                
            ];
            $session->set('detallescarrito', $detalleCarrito);
            $session->set('carrito', $carrito);
        }
        if($tipo == 2 || $tipo == 3){
            $carrito = $session->get('carrito',[]);
            $detallesCarrito = $session->get('detallescarrito',[]);
            // Crear un nuevo detallecarrito
            $nuevoDetalleCarrito = [
                'id' => (count($detallesCarrito))+1,
                'id_producto' => $producto->getId(),
                'prNombre' => $producto->getPrNombre(),
                'prDescripcion' => $producto->getPrDescripcion(),
                'prPrecio' => $producto->getPrPrecio(),
                'prImagenes' => json_decode($producto->getPrImagenes(), true),
                'dcCantidad' => $cantidad,
                'dcImporte' => $importe
            ];
            $carrito['cImportetotal'] += $importe;
            $carrito['cCantidad'] += $cantidad;
            $detallesCarrito[]=$nuevoDetalleCarrito;
            $session->set('carrito', $carrito);
            $session->set('detallescarrito',$detallesCarrito);
            
        }
        return $this->visualizarCarritosession();

    }

    public function visualizarCarritosession(){
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);
        $detallesCarrito = $session->get('detallescarrito', []);
        if(count($detallesCarrito)>0){
            $session->get('existencia_carrito',true);
        }else{
            $session->get('existencia_carrito',false);
        }
        return [
            'carrito' => $carrito,
            'detallescarrito' => $detallesCarrito,
        ];
    }

    private function AgregarProductoOperacion(int $tipo,usuario $usuario, Carrito $carrito,detallecarrito $detallecarrito, Producto $producto, int $cantidad)
    {
        $importe = $cantidad * $producto->getPrPrecio();
        
        try{

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
            
    
            if($tipo == 1){
                $this->entityManager->persist($carrito);
            }
    
            if($tipo == 1 || $tipo == 3){
                $this->entityManager->persist($detallecarrito);
            }
            $this->entityManager->flush();
            return true;

        }catch (\Exception $e) {
            return false;
        }
        
    }

    public function visualizarCarrito()
    {
        $session = $this->requestStack->getSession();
        $usuario = $this->usuario;
        if ($usuario === null) {
            return $this->visualizarCarritosession();
        } else {
            $this->entityManager->refresh($usuario);
            $carrito = $usuario->getCarrito();
            if ($carrito === null || $carrito->getDetallescarrito()->isEmpty()) {
                $session->set('existencia_carrito',false);
                return ['success' => true, 'carrito' => [], 'detallescarrito' => []];
            } else {
                $session->set('existencia_carrito',true);
                $detallescarrito = $carrito->getDetallescarrito();
                return $this->especificarDatos($carrito,$detallescarrito);
            }
        }
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

    public function modificarProducto(int $detallecarrito, int $cantidad)
    {
        $usuario = $this->usuario;
        if ($usuario === null) {
            return $this->ModificarcarritoSession($detallecarrito, $cantidad);
        } else {
            $carrito = $usuario->getCarrito();
            $detallecarrito = $this->detallecarritoRepository->findOneBy([
                'id' => $detallecarrito
            ]);
            return $this->ModificarCarritoOperacion($carrito,$detallecarrito,$cantidad);
        }
    }

    
    
    public function importarCarrito(){
        $session = $this->requestStack->getSession();
        $detallesCarrito = $session->get('detallescarrito', []);
        $longitud = count($detallesCarrito);
        $importacion = 0;
        foreach ($detallesCarrito as $key => $detalle) {
            $operacion = $this->agregarProducto($detalle['id_producto'], $detalle['dcCantidad']);
            if($operacion){
                $importacion++;
            }
        }
        if($importacion == $longitud){
            $session->remove('detallescarrito');
            $session->remove('carrito');
            $session->remove('pasarcarrito');
            return true;
        }else{
            return false;
        }
        
    }

    
    public function eliminarProducto(int $detallecarrito)
    {
        $usuario = $this->usuario;
    
        if ($usuario === null) {
            return $this->eliminarProductosession($detallecarrito);
        } else {
            $carrito = $usuario->getCarrito();
            $detallecarrito = $this->detallecarritoRepository->findOneBy([
                'id' => $detallecarrito
            ]);
            return $this-> ModificarCarritoOperacion($carrito,$detallecarrito,0);
        }
    }
    
    private function eliminarProductosession(int $idetalle){
        return $this->ModificarcarritoSession($idetalle,0);
    }

    private function ModificarcarritoSession(int $idetalle, int $cantidad){
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito',[]);
        $detallesCarrito = $session->get('detallescarrito', []);
        
        foreach ($detallesCarrito as $key => $detalle) {
            if ($detalle['id'] == $idetalle) {
                $difcantidad = $cantidad - $detalle['dcCantidad'];
                if ($difcantidad == 0) {
                    return $this->visualizarCarritosession();
                    break;
                }
    
                $difprecio = $detalle['prPrecio'] * $difcantidad;
                $carrito['cImportetotal'] += $difprecio;
                $carrito['cCantidad'] += $difcantidad;
    
                if ($cantidad == 0) {
                    unset($detallesCarrito[$key]);
                } else {
                    $detallesCarrito[$key]['dcCantidad'] = $cantidad;
                    $detallesCarrito[$key]['dcImporte'] = $cantidad * $detalle['prPrecio'];
                }
    
                $session->set('detallescarrito', $detallesCarrito);
                $session->set('carrito', $carrito);
                return $this->visualizarCarritosession();
                break;
            }
        }
        

        $session->set('detallecarrito', $detallesCarrito);
        return $this->visualizarCarritosession();
    }

    private function ModificarCarritoOperacion(Carrito $carrito, Detallecarrito $detallecarrito, int $cantidad)
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
        $detallecarrito->setDcImporte($producto->getPrPrecio() * $cantidad);
        $detallecarrito->setDcCantidad($cantidad);

        if ($detallecarrito->getDcCantidad() <= 0) {
            $carrito->removeDetallescarrito($detallecarrito);
            $this->entityManager->flush();
            // $carritoVisualizado = $this->visualizarCarrito();
            // $response = [
            //     'success' => true,
            //     'message' => 'Producto eliminado del carrito exitosamente.',
            // ];

            // if ($carrito->getDetallescarrito()->isEmpty()) {
            //     $response['estado'] = 'El carrito está vacío';
            //     $response['carrito'] = [
            //         'id' => $carrito->getId(),
            //         'cImportetotal' => $carrito->getCImportetotal()
            //     ];

            // } else {
            //     $response['carrito'] = $carritoVisualizado['carrito'];
            //     $response['detallescarrito'] = $carritoVisualizado['detallescarrito'];
            // }

            return $this->visualizarCarrito();
        }

        $this->entityManager->flush();
        return [
            'success' => true,
            'message' => 'Cantidad modificada exitosamente',
            'carrito' => $this->visualizarCarrito()['carrito'],
            'detallescarrito' => $this->visualizarCarrito()['detallescarrito'],
        ];
    }
    
    public function DevolverEstadoCarrito(){
        
    }
}