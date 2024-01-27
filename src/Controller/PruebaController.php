<?php

namespace App\Controller;

use App\Funciones\tiendaks\carrito\CarritoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PruebaController extends AbstractController
{
    #[Route('/prueba', name: 'app_prueba')]
    public function index(Request $request, CarritoFunciones $carritoFunciones): Response
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
                return $this->render('prueba/index.html.twig', [
                    'controller_name' => 'PruebaController',
                ]);
            }
            
        }else{
            return $this->render('prueba/index.html.twig', [
                'controller_name' => 'PruebaController',
            ]);
        }
        
    }
}
