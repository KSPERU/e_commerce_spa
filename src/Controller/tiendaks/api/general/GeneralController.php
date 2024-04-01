<?php

namespace App\Controller\tiendaks\api\general;

use App\Entity\Usuario\usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/general', name: 'app_api_general_')]
class GeneralController extends AbstractController
{
    #[Route('/acceder/general', name: 'acceder_general', methods: ['POST'])]
    public function accederGeneral(#[CurrentUser()] ?usuario $user, Request $request): Response
    {
        if(null === $user){
            return $this->json([
                'message' => 'Faltan credenciales',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $session = $request->getSession();
        $urlRedireccion = null;
        if($session->get('pasarcarrito')){
            $urlRedireccion = $this->generateUrl('app_carrito_mostrar_productos_global');
        }

        $token = base64_encode(random_bytes(32));

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token,
            'urlRedireccion' => $urlRedireccion
        ]);
    }
}