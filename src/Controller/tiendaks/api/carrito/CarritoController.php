<?php

namespace App\Controller\tiendaks\api\carrito;

use App\Repository\UsuarioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use App\Funciones\tiendaks\usuario\UsuarioFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Funciones\tiendaks\producto\en_desuso\ProductoFuncionesRevisado;

#[Route('/api/carrito', name: 'app_api_carrito_')]
class CarritoController extends AbstractController
{

    #[Route('/agregar/producto', name: 'agregar_producto', methods:['POST'])]
    public function agregarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $idproducto = $data['id_producto'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->agregarProducto($idproducto, $cantidad);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    #[Route('/eliminar/producto', name: 'eliminar_producto', methods:['POST'])]
    public function eliminarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $iddetallecarrito = $data['id_detalle_carrito'];
        $respuesta = $carritoFunciones->eliminarProducto($iddetallecarrito);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }


    #[Route('/modificar/producto', name: 'modificar_producto', methods:['POST'])]
    public function modificarProducto(Request $request, CarritoFunciones $carritoFunciones): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $iddetallecarrito = $data['id_detalle_carrito'];
        $cantidad = $data['cantidad'];
        $respuesta = $carritoFunciones->modificarProducto($iddetallecarrito, $cantidad);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }


    #[Route('/visualizar', name: 'visualizar', methods:['GET'])]
    public function visualizarCarrito(CarritoFunciones $carritoFunciones): JsonResponse
    {
        $respuesta = $carritoFunciones->visualizarCarrito();
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }
    
    #[Route('/listar/productos/prueba', name: 'listar_productos_prueba', methods: ['GET'])] //usando funcion en desuso acoplacion con el listado real
    public function listarProductos(ProductoFuncionesRevisado $productoFunciones): JsonResponse
    {
        $productos = $productoFunciones->especificarProductos($productoFunciones->obtenerProductosProcesado());
        return $this->json($productos, Response::HTTP_OK,[]);
    }

    #[Route('/listar/usuario', name: 'perfil_usuario', methods:['POST'])]
    public function profile(Request $request, UsuarioFunciones $usuarioFunciones): Response
    {
        $data = json_decode($request->getContent(),true);
        $idusuario = $data['id_usuario'];
        $respuesta = $usuarioFunciones->obtenerUsuarioVista($idusuario);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }

    #[Route('/perfil/propio', name: 'perfil_propio', methods:['POST'])]
    public function ownprofile(Request $request, UsuarioFunciones $usuarioFunciones): Response
    {
        $data = json_decode($request->getContent(),true);
        $idusuario = $data['id_usuario'];
        $respuesta = $usuarioFunciones->accesoPerfilPropio($idusuario);
        return $this->json($respuesta, Response::HTTP_OK,[]);
    }
}