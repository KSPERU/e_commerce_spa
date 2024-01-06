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

        public function agregarProducto(int $idproducto, int $cantidad): array
        {
        

        $usuario = $this->verificarUsuario();
        if($usuario === null){
            return ['success' => false, 'message' => 'Se necesita iniciar sesión para proceder con el proceso'];
        }else{
            $producto = $this->productoRepository->findOneBy([
                'id' => $idproducto
            ]);
            if ($producto->getPrStock() < $cantidad) {
                return ['success' => false, 'message' => 'El producto actualmente no está disponible.'];
            } else {
                $importe = $cantidad * $producto->getPrPrecio();
                $stockfinal = $producto->getPrStock() - $cantidad;
                if ($usuario->getCarrito() == null) {          
                    return $this->procesarNuevoCarrito($usuario,$producto,$cantidad,$importe,$stockfinal);
                } else {
                    return $this->procesarCarritoExistente($usuario,$producto,$cantidad,$importe,$stockfinal);
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

    private function procesarNuevoCarrito(usuario $usuario, producto $producto, int $cantidad, float $importe, int $stockfinal): array
    {
        $carrito = new Carrito();
        $carrito->setCCantidadtotal($cantidad);
        $carrito->setCImportetotal($importe);
        $carrito->setUsuario($usuario);
        $detallecarrito = new DetalleCarrito();
        $detallecarrito->setCarrito($carrito);
        $detallecarrito->setDcCantidad($cantidad);
        $detallecarrito->setProducto($producto);
        $detallecarrito->setDcImporte($importe);
        $producto->setPrStock($stockfinal);
        $carrito->addDetallescarrito($detallecarrito);
        $this->entityManager->persist($carrito);
        $this->entityManager->persist($detallecarrito);
        $this->entityManager->flush();
        return ['success' => true, 'message' => 'Producto agregado al carrito exitosamente.'];
    }

    private function procesarCarritoExistente(Usuario $usuario, Producto $producto, int $cantidad, float $importe, int $stockfinal): array
    {
        $carrito = $usuario->getCarrito();
        $existe = null;
        $detalles = $carrito->getDetallescarrito();

        foreach ($detalles as $detalle) {
            if ($detalle->getProducto() == $producto) {
                $detalle->setDcCantidad($detalle->getDcCantidad() + $cantidad);
                $detalle->setDcImporte($detalle->getDcImporte() + $importe);
                $carrito->setCCantidadtotal($carrito->getCCantidadtotal() + $cantidad);
                $carrito->setCImportetotal($carrito->getCImportetotal() + $importe);
                $producto->setPrStock($stockfinal);
                $this->entityManager->flush();
                $existe = true;
                break;
            }
        }

        if ($existe == null) {
            return $this->procesarNuevoDetalleCarrito($carrito, $producto, $cantidad, $importe, $stockfinal);
        }

        return ['success' => true, 'message' => 'Producto agregado al carrito exitosamente.'];
    }

    private function procesarNuevoDetalleCarrito(Carrito $carrito, Producto $producto, int $cantidad, float $importe, int $stockfinal): array
    {
        $detallecarrito = new DetalleCarrito();
        $detallecarrito->setDcCantidad($cantidad);
        $detallecarrito->setDcImporte($importe);
        $detallecarrito->setProducto($producto);

        $carrito->addDetallescarrito($detallecarrito);
        $carrito->setCCantidadtotal($carrito->getCCantidadtotal() + $cantidad);
        $carrito->setCImportetotal($carrito->getCImportetotal() + $importe);
        $producto->setPrStock($stockfinal);

        $this->entityManager->persist($detallecarrito);
        $this->entityManager->flush();

        return ['success' => true, 'message' => 'Producto agregado al carrito exitosamente.'];
    }
    

}