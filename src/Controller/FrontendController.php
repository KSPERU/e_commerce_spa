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


}


