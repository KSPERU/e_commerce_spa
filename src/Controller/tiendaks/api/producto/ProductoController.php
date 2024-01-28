<?php

namespace App\Controller\tiendaks\api\producto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductoController extends AbstractController
{
    #[Route('/tiendaks', name: 'app_listar_productos_global')]
    public function listarProductosGlobal(Request $request, CarritoFunciones $carritoFunciones): Response
    {
        
        $session = $request->getSession();
        if($session->get('comprar')){

            if($session->get('pasarcarrito') && $session->get('detallescarrito')){
                $operacion = $carritoFunciones->importarCarrito();
                if($operacion){
                    return $this->redirectToRoute('app_tiendaks_vistacarrito');
                }else{
                    return $this->redirectToRoute('app_prueba');
                }
            }else{
                return $this->render('backend/tiendaks/producto/listarProductoGlobal.html.twig', [
                ]);
            }
            
        }else{
            return $this->render('backend/tiendaks/producto/listarProductoGlobal.html.twig', [
            ]);
        }
        
    }
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

    #[Route('/api/producto/listado/{categoria}/stock', name: 'app_api_producto_listado_categorizados_stock', methods: ['GET'])]
    public function listarProductosCategorizadosConStock(string $categoria, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosFiltradosCategorizadosConStock($categoria));
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
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    # Metodo compuesto
    #[Route('/api/producto/listado/{categoria}/por/{atributo}/ordenado/{modo}/de/{inicio}/entre/{fin}', name: 'app_api_producto_clasificar', methods: ['GET'])]
    public function clasificaciónProducto(string $categoria, string $atributo, string $modo, float $inicio, float $fin, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductosClasificados($categoria, $atributo, $modo, $inicio, $fin);
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/api/producto/listado/categoria/stock', name: 'app_api_producto_categoria_stock', methods: ['POST'])]
    public function categoriaConMenuDeFiltros(Request $request, ProductoFunciones $productoFunciones): JsonResponse
    {
        $datos = json_decode($request->getContent(),true);
        $categorias = $datos["categorias"];
        $atributos = $datos["atributos"];
        $busqueda = $datos["busqueda"];
        $productos = $productoFunciones->obtenerProductosClasificadosStock($categorias, $atributos, $busqueda);
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #1ra iteración
    #[Route('/api/producto/listado/usuario/{usuario}', name: 'app_api_producto_listado_usuario', methods: ['GET'])]
    public function listadoPorUsuario(int $usuario, ProductoFunciones $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->obtenerProductorPorUsuarioArray($usuario);
        return $this->json($productos, Response::HTTP_OK,[]);
    }
}