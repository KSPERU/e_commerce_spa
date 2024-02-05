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
    public function mostrarProductoListado(): Response
    {
        return $this->render('backend/tiendaks/producto/mostrarProductoListado.html.twig');
    }

    # Vista Productos por Categoria
    #[Route('/mostrar/producto/listadoporcategoria', name: 'mostar_producto_listadoporcategoria')]
    public function mostrarProductoListadoPorCategoria(): Response
    {
        return $this->render('backend/tiendaks/producto/mostrarProductoListadoPorCategoria.html.twig', [
            'categoria' => 'skincare'
        ]); 
    }

    # Vista Ver Producto
    #[Route('/mostrar/producto/porid', name: 'mostar_producto_porid')]
    public function mostrarProductoPorId(): Response
    {
        return $this->render('backend/tiendaks/producto/mostrarProductoPorId.html.twig', [
            'producto_id' => 2
        ]);
    }
}