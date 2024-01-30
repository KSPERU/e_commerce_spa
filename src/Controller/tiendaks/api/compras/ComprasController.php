<?php

namespace App\Controller\tiendaks\api\compras;

use App\Funciones\tiendaks\compras\ComprasFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/compras', name: 'app_api_compras_')]
class ComprasController extends AbstractController
{
    #[Route('/mostrar/compras/listadodeapis', name: 'mostar_compras_listadodeapis')]
    public function mostrarProductoListadoDeApis(): Response
    {
        return $this->render('backend/tiendaks/compras/index.html.twig');
    }

    #[Route('/listar/compras/concriterios', name: 'listar_compras_concriterios', methods: ['POST'])]
    public function listarProductoConCriterios(Request $request, ComprasFunciones $comprasFunciones): JsonResponse
    {
        $datos = json_decode($request->getContent(),true);
        $compras = ($datos !== null) ? $comprasFunciones->obtenerComprasTodos($datos) : $comprasFunciones->obtenerComprasTodos();
        return $this->json($compras, Response::HTTP_OK,[]);
    }
}