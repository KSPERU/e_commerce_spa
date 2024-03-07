<?php

namespace App\Controller\tiendaks\backend\usuario;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsuarioController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
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

    #[Route('/perfil-usuario/{id}', name: 'app_perfil_usuario')]
    public function profile(): Response
    {
        return $this->render('backend/tiendaks/usuario/index.html.twig', [
        ]);
    }
}
