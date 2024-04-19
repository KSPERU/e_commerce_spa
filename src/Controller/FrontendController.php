<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    #[Route('/', name: 'app_frontend')]
    public function index(): Response
    {
        return $this->render('frontend/index.html.twig', []);
    }

    #[Route('/carrito_vacio', name: 'app_carrito_vacio')]
    public function carrito_vacio(): Response
    {
        return $this->render('frontend/carrito.html.twig', []);
    }

    #[Route('/carrito', name: 'app_carrito')]
    public function carrito(): Response
    {
        return $this->render('frontend/carrito2.html.twig', []);
    }

    #[Route('/checkout', name: 'app_checkout')]
    public function checkout(): Response
    {
        return $this->render('frontend/checkout.html.twig', []);
    }


    #[Route('/perfil-usuario', name: 'app_frontend_perfil_usuario')]
    public function perfil_usuario(): Response
    {
        return $this->render('frontend/perfil_usuario.html.twig', []);
    }

    #[Route('/productos-categoria', name: 'app_frontend_productos_categoria')]
    public function productos_categoria(): Response
    {
        return $this->render('frontend/productos_categoria.html.twig', []);
    }

    #[Route('/perfil-usuario-settings', name: 'app_frontend_perfil_usuario_settings')]
    public function perfil_usuario_settings(): Response
    {
        return $this->render('frontend/perfil_usuario_settings.html.twig', []);
    }

    #[Route('/mi-perfil-movil', name: 'app_frontend_mi_perfil_movil')]
    public function mi_perfil_movil(): Response
    {
        return $this->render('frontend/mi_perfil_movil.html.twig', []);
    }

    #[Route('/compras-movil', name: 'app_frontend_compras_movil')]
    public function compras_movil(): Response
    {
        return $this->render('frontend/compras_movil.html.twig', []);
    }

    #[Route('/ventas-movil', name: 'app_frontend_ventas_movil')]
    public function ventas_movil(): Response
    {
        return $this->render('frontend/ventas_movil.html.twig', []);
    }

    #[Route('/configuracion-movil', name: 'app_frontend_configuracion_movil')]
    public function configuracion_movil(): Response
    {
        return $this->render('frontend/configuracion_movil.html.twig', []);
    }

}


