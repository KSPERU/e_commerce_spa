<?php

namespace App\Controller\tiendaks\api\carrito;

use App\Funciones\tiendaks\carrito\CarritoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    #[Route('/tiendaks/api/carrito/carrito', name: 'app_tiendaks_api_carrito_carrito')]
    public function index(): Response
    {
        return $this->render('tiendaks/api/carrito/carrito/index.html.twig', [
            'controller_name' => 'CarritoController',
        ]);
    }

    #[Route('/api/carrito/agregar', name: 'app_api_carrito_agregar', methods:['POST'])]
    public function agregarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $idproducto = $data['id_producto'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->agregarProducto($idproducto, $cantidad);
        return new JsonResponse($respuesta, Response::HTTP_OK, []);
    }

    //método get para agregar producto a carrito
    // #[Route('/api/carrito/agregar/{idproducto}/{cantidad}', name: 'app_api_carrito_agregar', methods:['GET'])]
    // public function agregarProducto(int $idproducto, int $cantidad, Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    // {
        
    //     $respuesta = $carritoFunciones->agregarProducto($idproducto, $cantidad);
    //     return new JsonResponse($respuesta, Response::HTTP_OK, []);
    // }
}
