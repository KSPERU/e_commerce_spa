<?php

namespace App\Controller\tiendaks\api\carrito;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use App\Funciones\tiendaks\pruebas\PruebaFunciones;
use App\Repository\Producto\productoRepository;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarritoController extends AbstractController
{
    #[Route('/tiendaks/carrito', name: 'app_tiendaks_vistacarrito')]
    public function vistacarrito(Request $request, productoRepository $productoRepository): Response
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
                //return $this->redirectToRoute('app_login');
            }
        }
        $session = $request->getSession();
        $session->remove('comprar');
        return $this->render('backend/tiendaks/carrito/carrito.html.twig', [
            'controller_name' => 'CarritoController',
            'iniciarSesion' => $iniciarSesion,
            'producto' => ($productoRepository->findAll())[0],
        ]);
    }

    #[Route('/api/carrito/agregar', name: 'app_api_carrito_agregar', methods:['POST'])]
    public function agregarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $idproducto = $data['id_producto'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->agregarProductoACarrito($idproducto, $cantidad);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    #[Route('/api/carrito/eliminar', name: 'app_api_carrito_eliminar', methods:['POST'])]
    public function eliminarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $iddetallecarrito = $data['id_detalle_carrito'];
        $respuesta = $carritoFunciones->eliminarProducto($iddetallecarrito);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    // #[Route('/api/carrito/eliminar', name: 'app_api_carrito_eliminar', methods:['POST'])]
    // public function eliminarProducto(Request $request, PruebaFunciones $carritoFunciones): JsonResponse
    // {
    //     $data = json_decode($request->getContent(),true);
    //     $iddetallecarrito = $data['id_detalle_carrito'];
    //     $respuesta = $carritoFunciones->eliminarcarrito($iddetallecarrito);
    //     return $this->json($respuesta, Response::HTTP_OK,[]);
    // }

    #[Route('/api/carrito/modificar', name: 'app_api_carrito_modificar', methods:['POST'])]
    public function modificarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $iddetallecarrito = $data['id_detalle_carrito'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->modificarProducto($iddetallecarrito, $cantidad);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    // #[Route('/api/carrito/modificar', name: 'app_api_carrito_modificar', methods:['POST'])]
    // public function modificarProducto(Request $request, PruebaFunciones $pruebaFunciones): JsonResponse
    // {
    //     $data = json_decode($request->getContent(),true);
    //     $iddetallecarrito = $data['id_detalle_carrito'];
    //     $cantidad = $data['cantidad'];
    //     $respuesta = $pruebaFunciones->modificarCarrito($iddetallecarrito, $cantidad);
    //     return $this->json($respuesta, Response::HTTP_OK,[]);
    // }

    #[Route('/api/carrito/visualizar', name: 'app_api_carrito_visualizar', methods:['GET'])]
    public function visualizarProducto(CarritoFunciones $carritoFunciones): JsonResponse
    {
        $respuesta = $carritoFunciones->visualizarCarrito();
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    // #[Route('/api/carrito/visualizar', name: 'app_api_carrito_visualizar', methods:['GET'])]
    // public function visualizarProducto(PruebaFunciones $pruebaFunciones, Request $request): JsonResponse
    // {
    //     $respuesta = $pruebaFunciones->crearCarrito();
    //     return $this->json($respuesta, Response::HTTP_OK,[]);
    // }
    //método get para agregar producto a carrito
    // #[Route('/api/carrito/agregar/{idproducto}/{cantidad}', name: 'app_api_carrito_agregar', methods:['GET'])]
    // public function agregarProducto(int $idproducto, int $cantidad, Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    // {
        
    //     $respuesta = $carritoFunciones->agregarProducto($idproducto, $cantidad);
    //     return new JsonResponse($respuesta, Response::HTTP_OK, []);
    // }
}