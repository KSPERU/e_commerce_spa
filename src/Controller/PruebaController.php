<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PruebaController extends AbstractController
{
    #[Route('/prueba', name: 'app_prueba')]
    public function index(): Response
    {
        return $this->render('prueba/index.html.twig', [
            'controller_name' => 'PruebaController',
        ]);
    }

    #[Route('/prueba-list', name: 'app_prueba_list', methods:['GET'])]
    public function vueList(ProductoRepository $productoRepository): JsonResponse
    {
        // $datos = ["raroooo","rata", "Excelente"]; 
        $datos = $productoRepository->findAll();
        return $this->json($datos);
    }

    #[Route('/prueba-list/create', name: 'app_prueba_create', methods:['POST'])]
    public function vueCreate(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $producto = new Producto();   

        // Necesario para testear API en POSTMAN
        // $producto->setNombre($request->request->get('nombre'));
        // $producto->setCategoria($request->request->get('categoria'));
        // $producto->setCantidad($request->request->get('cantidad'));
        // $producto->setPrecio($request->request->get('precio'));

        $producto->setNombre($data['nombre']);
        $producto->setCategoria($data['categoria']);
        $producto->setCantidad($data['cantidad']);
        $producto->setPrecio($data['precio']);
        $entityManager->persist($producto);
        $entityManager->flush();

        return $this->json($producto);
    }

    #[Route('/prueba-list/{id}', name: 'app_prueba_show', methods:['GET'])]
    public function vueShow(int $id, ProductoRepository $productoRepository): JsonResponse
    {
        // $datos = ["raroooo","rata", "Excelente"]; 
        // $datos = [
        //     ['id' => 1, 'name' => 'Harold'],
        //     ['id' => 2, 'name' => 'Hans']
        // ];
        $datos = $productoRepository->find(['id' => $id]);
        return $this->json($datos);
    }
    
    #[Route('/prueba-list/edit/{id}', name: 'app_prueba_edit', methods:['PUT', 'PATCH'])]
    public function vueEdit(Producto $producto, ProductoRepository $productoRepository, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // $datos = ["raroooo","rata", "Excelente"]; 
        // $datos = [
        //     ['id' => 1, 'name' => 'Harold'],
        //     ['id' => 2, 'name' => 'Hans']
        // ];
        $data = json_decode($request->getContent(), true);

        // $producto = $productoRepository->find(['id' => $id]);

        // $producto->setNombre($request->request->get('nombre'));
        // $producto->setCategoria($request->request->get('categoria'));
        // $producto->setCantidad($request->request->get('cantidad'));
        // $producto->setPrecio($request->request->get('precio'));

        $producto->setNombre($data['nombre']);
        $producto->setCategoria($data['categoria']);
        $producto->setCantidad($data['cantidad']);
        $producto->setPrecio($data['precio']);

        $entityManager->flush();

        return $this->json($producto);
    }

    #[Route('/prueba-list/delete/{id}', name: 'app_prueba_delete', methods:['DELETE'])]
    public function vueDelete(Producto $producto, ProductoRepository $productoRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        // $datos = $productoRepository->find(['id' => $id]);
        $entityManager->remove($producto);
        $entityManager->flush();
        return $this->json($producto);
    }

    #[Route('/prueba-list/{categoria}/cat', name: 'app_prueba_cat', methods:['GET'])]
    public function vueCat($categoria, ProductoRepository $productoRepository): JsonResponse
    {
        $datos = $productoRepository->findBy(['categoria' => $categoria]);
        return $this->json($datos);
    }
}
