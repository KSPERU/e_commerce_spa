<?php

namespace App\Funciones\tiendaks\carrito;

use App\Entity\Carrito\carrito;
use App\Entity\Usuario\usuario;
use App\Entity\Producto\producto;
use App\Entity\Carrito\detallecarrito;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\Carrito\carritoRepository;
use App\Repository\Usuario\usuarioRepository;
use App\Repository\Producto\productoRepository;
use App\Repository\Carrito\detallecarritoRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class CarritoFunciones
{
    private $productoRepository;
    private $carritoRepository;
    private $detallecarritoRepository;
    private $usuarioRepository;
    private $httpClientInterface;
    private $entityManager;
    private $security;

    public function __construct(Security $security, productoRepository $productoRepository, carritoRepository $carritoRepository, detallecarritoRepository $detallecarritoRepository, usuarioRepository $usuarioRepository, HttpClientInterface $httpClientInterface, EntityManagerInterface $entityManager)
    {
        $this->productoRepository = $productoRepository;
        $this->carritoRepository = $carritoRepository;
        $this->detallecarritoRepository = $detallecarritoRepository;
        $this->httpClientInterface = $httpClientInterface;
        $this->usuarioRepository = $usuarioRepository;
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

        public function agregarProducto(int $idproducto, int $cantidad)
        {
        

        // $usuario = $this->verificarUsuario();
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => 2
        ]);
        if($usuario === null){
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para proceder con el proceso'];
        }else{
            $producto = $this->productoRepository->findOneBy([
                'id' => $idproducto
            ]);
            if ($producto->getPrStock() < $cantidad) {
                return ['success' => false, 'message' => 'El producto actualmente no está disponible.'];
            } else {
                
                $stockfinal = $producto->getPrStock() - $cantidad;
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

    private function verificarUsuario()
    {
        $user = $this->security->getUser();
        if ($user === null) {
            return null; // Si el usuario no está autenticado, retorna null
        }
    
        $usuario = $this->usuarioRepository->findOneBy([
            'u_correo' => $user->getUserIdentifier()
        ]);
        return $usuario;
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
        $detallescarrito = $carrito->getDetallescarrito();

        $this->entityManager->flush();
        return [
            'success' => true,
            'message' => 'Producto agregado al carrito exitosamente.',
            'detallescarrito' => $detallescarrito
        ];
    }

    public function modificarProducto(int $detallecarrito, int $cantidad)
    {
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => 2
        ]);
    
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
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => 2
        ]);
    
        if ($usuario === null) {
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para ver el resumen del carrito'];
        } else {
            $carrito = $usuario->getCarrito();
    
            if ($carrito === null || $carrito->getDetallescarrito()->isEmpty()) {
                return ['success' => true, 'message' => 'El carrito está vacío'];
            } else {
                $detalles = $carrito->getDetallescarrito();
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
                return [
                    'detallescarrito' => $detalles,
                ];
            }
        }
    }    

    public function eliminarProducto(int $detallecarrito)
    {
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => 2
        ]);
    
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
        $detallescarrito = $carrito->getDetallescarrito();
        $difprecio = $producto->getPrPrecio() * $difcantidad;
        if($difcantidad > $producto->getPrStock()){
            return [
                'success' => false,
                'message' => 'La cantidad supera el de los productos disponibles.',
            ];
        }
        $carrito->setCCantidadtotal($carrito->getCCantidadtotal() + $difcantidad);
        $carrito->setCImportetotal($carrito->getCImportetotal() + $difprecio);
        $producto->setPrStock($producto->getPrStock() - $difcantidad);
        $detallecarrito->setDcImporte($producto->getPrPrecio() * $cantidad);
        $detallecarrito->setDcCantidad($cantidad);

        if ($detallecarrito->getDcCantidad() <= 0) {
            $carrito->removeDetallescarrito($detallecarrito);
            $this->entityManager->flush();
            return [
                'success' => true,
                'message' => 'Producto eliminado del carrito exitosamente.',
                'detallescarrito' => $detallescarrito
            ];
        }

        $this->entityManager->flush();
        return [
            'success' => true,
            'message' => 'Cantidad modificada exitosamente',
            'detallescarrito' => $detallescarrito
        ];
    }    
}