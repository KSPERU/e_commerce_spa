<?php

namespace App\Controller\tiendaks\api\general;

use App\Entity\Usuario\usuario;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/api/general', name: 'app_api_general_')]
class GeneralController extends AbstractController
{
    #[Route('/acceder/general', name: 'acceder_general', methods: ['POST'])]
    public function accederGeneral(#[CurrentUser()] ?usuario $user): Response
    {
        if(null === $user){
            return $this->json([
                'message' => 'Faltan credenciales',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = base64_encode(random_bytes(32));

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token
        ]);
    }
}