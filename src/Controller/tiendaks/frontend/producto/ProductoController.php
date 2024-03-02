<?php

namespace App\Controller\tiendaks\frontend\producto;

use App\Entity\Producto\producto;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use App\Repository\Usuario\usuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/producto', name: 'app_tiendaks_frontend_producto_producto_')]
class ProductoController extends AbstractController
{
    # Ver Producto
    #[Route('/{producto_id}', name: 'verproducto')]
    public function redireccionInicio(int $producto_id, ProductoFunciones $productoFunciones, usuarioRepository $usuarioRepository): Response
    {
        #Configuracion de usuario
        $user = $this->getUser();
        $logged = false;
        $usuario = null;
        if($user){
            $logged = true;
            $usuario = $usuarioRepository->findOneBy([
                'u_correo' => $user->getUserIdentifier(),
            ]);
        }

        #Configuracion de entorno
        $categorias = $productoFunciones->obtenerProductoListadoCategoriasConOrden();

        return $this->render('frontend/tiendaks/producto/verproducto.html.twig', [
            'usuarioLogeado' => [
                'logged' => $logged,
                'valor' => $usuario,
            ],
            'configuracionEntorno' => [
                'categorias' => $categorias,
            ],
            'producto_id' => $producto_id
        ]);
    }
}