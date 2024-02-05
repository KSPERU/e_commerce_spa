<?php

namespace App\Controller\tiendaks\backend\producto;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backend/producto', name: 'app_backend_producto_')]
class ProductoController extends AbstractController
{
    # Vista Inicio
    #[Route('/mostrar/producto/listado', name: 'mostar_producto_listado')]
    public function mostrarProductoListadoDeApis(): Response
    {
        return $this->render('backend/tiendaks/producto/mostrarProductoListado.html.twig');
    }
}