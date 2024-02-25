<?php

namespace App\Controller\tiendaks\api\usuario;

use App\Funciones\tiendaks\usuario\UsuarioFunciones;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/usuario', name: 'app_api_usuario_')]
class UsuarioController extends AbstractController
{
    
    #[Route('/obtener/idusuario/logueado', name: 'obtener_IdUsuarioLogueado', methods: ['GET'])]
    public function obtenerIdUsuarioLogueado(UsuarioFunciones $usuarioFunciones): JsonResponse
    {
        $resultado = $usuarioFunciones->obtenerIdUsuarioLogueado();
        return $this->json($resultado, Response::HTTP_OK,[]);
    }
}
