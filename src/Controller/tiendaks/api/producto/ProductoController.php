<?php

namespace App\Controller\tiendaks\api\producto;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProductoController extends AbstractController
{
    #[Route('/api/producto', name: 'app_api_producto')]
    public function index(): Response
    {
        return $this->render('backend/tiendaks/producto/index.html.twig');
    }

    #[Route('/api/producto/listado', name: 'app_api_producto_listado', methods: ['GET'])]
    public function listarProductos(ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosProcesado();
        //return $this->json($productos);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    #[Route('/api/producto/listado/{pagina}/total/{cantidad}', name: 'app_api_producto_listado_paginados', methods: ['GET'])]
    public function listarProductosPaginados(int $pagina, int $cantidad, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosFiltradosPaginados($pagina, $cantidad);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    #[Route('/api/producto/listado/{categoria}', name: 'app_api_producto_listado_categorizados', methods: ['GET'])]
    public function listarProductosCategorizados(string $categoria, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosFiltradosCategorizados($categoria);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    #[Route('/api/producto/listado/costo/{inicio}/entre/{fin}', name: 'app_api_producto_listado_precios', methods: ['GET'])]
    public function listarProductosPrecios(float $inicio, float $fin, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosFiltradosEstimados($inicio, $fin);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    #[Route('/api/producto/listado/{categoria}/ordenado/{modo}', name: 'app_api_producto_listado_ordenado', methods: ['GET'])]
    public function listarProductosOrdenado(string $categoria, string $modo, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosFiltradosOrdenados($categoria, $modo);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    #[Route('/api/producto/ver/{id}', name: 'app_api_producto_ver', methods: ['GET'])]
    public function verProducto(int $id, ProductoFunciones $productoFunciones): JsonResponse
    {
        $producto = $productoFunciones->verProductoProcesado($id);
        return $this->json($producto, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    #[Route('/api/producto/buscar/{busqueda}', name: 'app_api_producto_buscar', methods: ['GET'])]
    public function buscarProducto(string $busqueda, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->buscarProducto($busqueda);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }
}