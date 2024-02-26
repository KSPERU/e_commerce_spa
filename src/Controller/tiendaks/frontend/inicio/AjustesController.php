<?php

namespace App\Controller\tiendaks\frontend\inicio;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjustesController extends AbstractController
{
    # Redireccion
    #[Route('/', name: 'app_frontend_rediccion_inicio')]
    public function redireccionInicio(): Response
    {
        return $this->redirectToRoute('app_frontend_inicio_mostrar_inicio');
    }
}