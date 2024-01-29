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

}


