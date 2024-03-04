<?php

namespace App\Controller\tiendaks\backend\carrito;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tiendaks', name: 'app_carrito_')]
class CarritoController extends AbstractController
{
    #[Route('/global', name: 'mostrar_productos_global')]
    public function listarProductosGlobal(Request $request, CarritoFunciones $carritoFunciones): Response
    {
        
        $session = $request->getSession();
        if($session->get('comprar')){

            if($session->get('pasarcarrito')){
                $session->remove('iniciarsesion');
                $operacion = $carritoFunciones->importarCarrito();
                if($operacion){
                    $session->remove('pasarcarrito');
                    
                }else{
                    return $this->redirectToRoute('app_carrito_mostrar_productos_global');
                }
            }
            return $this->redirectToRoute('app_test_frontend_app_checkout');
            
        }else{
            // return $this->render('frontend/index.html.twig', [
            // ]);
            return $this->render('backend/tiendaks/producto/listarProductoGlobal.html.twig', [
            ]);
        }
        
    }

    #[Route('/carrito', name: 'mostrar_vista_carrito')]
    public function MostrarVistacarrito(Request $request): Response
    {

        if ($request->isMethod('POST')) {
            $session = $request->getSession();
            if(empty($this->getUser())){           
                $session->set('pasarcarrito',true);
                
                $url = $this->generateUrl('app_login');
            }else{
                $url = $this->generateUrl('app_carrito_mostrar_productos_global');
            }
            $session->set('comprar',true);
            return new JsonResponse(['url' => $url]);
            
        }
        $session = $request->getSession();
        $session->remove('iniciarsesion');
        return $this->render('backend/tiendaks/carrito/carrito.html.twig', [
            'controller_name' => 'CarritoController',
            
        ]);
    }
}
