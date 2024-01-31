<?php

namespace App\Controller\tiendaks\api\producto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/producto', name: 'app_api_producto_')]
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