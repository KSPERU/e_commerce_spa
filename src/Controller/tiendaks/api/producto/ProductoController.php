<?php

namespace App\Controller\tiendaks\api\producto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/producto', name: 'app_api_producto_')]
class ProductoController extends AbstractController
{
    
    #[Route('/mostrar/producto/listadodeapis', name: 'mostar_producto_listadodeapis')]
    public function mostrarProductoListadoDeApis(): Response
    {
        return $this->render('backend/tiendaks/producto/index.html.twig');
    }

    #[Route('/listar/producto/concriterios', name: 'listar_producto_concriterios', methods: ['POST'])]
    public function listarProductoConCriterios(Request $request, ProductoFunciones $productoFunciones): JsonResponse
    {
        $datos = json_decode($request->getContent(),true);
        $productos = ($datos !== null) ? $productoFunciones->obtenerProductoTodosOLlenarSiVacio($datos) : $productoFunciones->obtenerProductoTodosOLlenarSiVacio();
        return $this->json($productos, Response::HTTP_OK,[]);
    }
}