<?php

namespace App\Controller\tiendaks\backend\producto;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{
    #[Route('/tiendaks/{categoria}', name: 'app_backend_producto_categoria')]
    public function productoPorCategoria(): Response
    {
        return $this->render('backend/tiendaks/producto/categoria.html.twig');
    }
}