<?php

namespace App\Controller\tiendaks\frontend\inicio;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjustesController extends AbstractController
{
    # Redireccion
    #[Route('/', name: 'app_tiendaks_frontend_inicio_ajustes_rediccion')]
    public function redireccionInicio(): Response
    {
        return $this->redirectToRoute('app_tiendaks_frontend_inicio_inicio_mostrarinicio');
    }
}