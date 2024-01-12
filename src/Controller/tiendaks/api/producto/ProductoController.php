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
        //$productos = $productoFunciones->obtenerProductosProcesado();
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosProcesado());
        //return $this->json($productos);
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/listado/{pagina}/total/{cantidad}', name: 'app_api_producto_listado_paginados', methods: ['GET'])]
    public function listarProductosPaginados(int $pagina, int $cantidad, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosFiltradosPaginados($pagina, $cantidad));
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/listado/{categoria}', name: 'app_api_producto_listado_categorizados', methods: ['GET'])]
    public function listarProductosCategorizados(string $categoria, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosFiltradosCategorizados($categoria));
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/listado/costo/{inicio}/entre/{fin}', name: 'app_api_producto_listado_precios', methods: ['GET'])]
    public function listarProductosPrecios(float $inicio, float $fin, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosFiltradosEstimados($inicio, $fin));
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/listado/{atributo}/ordenado/{modo}', name: 'app_api_producto_listado_ordenado', methods: ['GET'])]
    public function listarProductosOrdenado(string $atributo, string $modo, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosFiltradosOrdenados($atributo, $modo));
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/ver/{id}', name: 'app_api_producto_ver', methods: ['GET'])]
    public function verProducto(int $id, ProductoFunciones $productoFunciones): JsonResponse
    {
        $producto = $productoFunciones->verProductoProcesado($id);
        return $this->json($producto, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/buscar/{busqueda}', name: 'app_api_producto_buscar', methods: ['GET'])]
    public function buscarProducto(string $busqueda, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->buscarProducto($busqueda);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }

    # Metodo compuesto
    #[Route('/api/producto/listado/{categoria}/por/{atributo}/ordenado/{modo}/de/{inicio}/entre/{fin}', name: 'app_api_producto_clasificar', methods: ['GET'])]
    public function clasificaciónProducto(string $categoria, string $atributo, string $modo, float $inicio, float $fin, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosClasificados($categoria, $atributo, $modo, $inicio, $fin);
        return $this->json($productos, Response::HTTP_OK,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER=>function ($articulo){ return $articulo->getId(); }]);
    }
}