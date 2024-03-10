<?php

namespace App\Controller\tiendaks\api\producto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/producto', name: 'app_api_producto_')]
class ProductoController extends AbstractController
{
    const ATTRIBUTES_TO_SERIALIZE = ['id', 'pr_nombre', 'pr_categoria','pr_stock', 'pr_precio'];

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

    #[Route('/listar/producto/listadocategorias', name: 'listar_producto_listadocategorias', methods: ['POST'])]
    public function listarProductosCategorizadosConStock(Request $request, ProductoFunciones $productoFunciones): JsonResponse
    {
        $datos = json_decode($request->getContent(),true);
        $categorias = ($datos !== null) ? $productoFunciones->obtenerProductoListadoCategoriasConOrden($datos) : $productoFunciones->obtenerProductoListadoCategoriasConOrden();
        return $this->json($categorias, Response::HTTP_OK,[]);
    }

    #[Route('/api/productos', name: 'api_productos_add', methods: ['POST'])]
    public function addProducto(Request $request, ProductoFunciones $productoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $usuario = $this->getUser();
        $respuesta = $productoFunciones->añadirproducto($data, $usuario);
        return $this->json($respuesta, Response::HTTP_CREATED, [], [
            'attributes' => self::ATTRIBUTES_TO_SERIALIZE
        ]);
    }
}