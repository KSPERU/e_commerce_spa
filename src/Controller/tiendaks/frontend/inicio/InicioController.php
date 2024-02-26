<?php

namespace App\Controller\tiendaks\frontend\inicio;

use App\Funciones\tiendaks\producto\ProductoFunciones;
use App\Repository\Usuario\usuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_frontend_inicio_')]
class InicioController extends AbstractController
{
    # Vista Inicio
    #[Route('inicio', name: 'mostrar_inicio')]
    public function mostrarInicio(ProductoFunciones $productoFunciones, usuarioRepository $usuarioRepository): Response
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

        return $this->render('frontend/tiendaks/inicio/index.html.twig', [
            'usuarioLogeado' => [
                'logged' => $logged,
                'valor' => $usuario,
            ],
            'configuracionEntorno' => [
                'categorias' => $categorias,
            ]
        ]);
    }
}