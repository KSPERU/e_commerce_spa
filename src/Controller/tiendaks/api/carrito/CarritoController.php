<?php

namespace App\Controller\tiendaks\api\carrito;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarritoController extends AbstractController
{
    #[Route('/tiendaks/carrito', name: 'app_carrito_mostrar_vistacarrito')]
    public function carritoMostrarVistacarrito(Request $request): Response
    {
        $iniciarSesion = false;
        if ($request->isMethod('POST')) {
            
            if(empty($this->getUser())){
                $session = $request->getSession();
                $session->set('pasarcarrito',true);
                $session->set('comprar',true);
                $iniciarSesion = true;
                return $this->render('backend/tiendaks/carrito/carrito.html.twig', [
                    'controller_name' => 'CarritoController',
                    'iniciarSesion' => $iniciarSesion,
                ]);
            }
        }
        $session = $request->getSession();
        $session->remove('comprar');
        return $this->render('backend/tiendaks/carrito/carrito.html.twig', [
            'controller_name' => 'CarritoController',
            'iniciarSesion' => $iniciarSesion,
        ]);
    }

    #[Route('/api/carrito/agregar/producto', name: 'app_api_carrito_agregar_producto', methods:['POST'])]
    public function agregarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $idproducto = $data['id_producto'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->agregarProducto($idproducto, $cantidad);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    #[Route('/api/carrito/eliminar/producto', name: 'app_api_carrito_eliminar_producto', methods:['POST'])]
    public function eliminarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $iddetallecarrito = $data['id_detalle_carrito'];
        $respuesta = $carritoFunciones->eliminarProducto($iddetallecarrito);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }


    #[Route('/api/carrito/modificar/producto', name: 'app_api_carrito_modificar_producto', methods:['POST'])]
    public function modificarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $iddetallecarrito = $data['id_detalle_carrito'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->modificarProducto($iddetallecarrito, $cantidad);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }


    #[Route('/api/carrito/visualizar', name: 'app_api_carrito_visualizar', methods:['GET'])]
    public function visualizarCarrito(CarritoFunciones $carritoFunciones): JsonResponse
    {
        $respuesta = $carritoFunciones->visualizarCarrito();
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    #[Route('/api/carrito/comprar', name: 'app_api_carrito_comprar', methods:['GET'])]
    public function comprarCarrito(CarritoFunciones $carritoFunciones): JsonResponse
    {
        $respuesta = $carritoFunciones->visualizarCarrito();
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

}