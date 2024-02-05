<?php

namespace App\Controller;

use App\Entity\Producto\producto;
use App\Entity\Usuario\usuario;
use App\Form\ProductoType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Usuario\usuarioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Funciones\tiendaks\carrito\CarritoFunciones;
use App\Repository\Producto\productoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/tienda/user/{id}', name: 'app_tienda_user_profile')]
    public function profile(int $id, UsuarioRepository $usuarioRepository): Response
    {
        $perfil = $usuarioRepository->findOneBy(['id' => $id]);
        $usuarioActual = $this->getUser();
        if ($usuarioActual && $perfil && $usuarioActual->getId() === $perfil->getId()) {
            $PerfilPropio = true;
        } else {
            $PerfilPropio = false;
        }

        return $this->render('tienda_user/index.html.twig', [
            'usuario' => $perfil,
            'perfil'=> $PerfilPropio,
        ]);
    }

    #[Route('/tienda/user/{id}/nuevo-producto', name: 'app_tienda_nuevo_producto')]
    public function nuevoProducto(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuarioActual = $this->getUser();
        $producto = new producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $producto->setUsuario($usuarioActual);
            $entityManager->persist($producto);
            $entityManager->flush();
            return $this->redirectToRoute('app_tienda_user_profile', ['id' => $id]);
        }

        return $this->render('tienda_user/nuevo_producto.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/tienda/user/{id}/actualizar-productos', name: 'app_tienda_actualizar_productos')]
    public function actualizarProductos(int $id, UsuarioRepository $usuarioRepository): Response
    {
        $perfil = $usuarioRepository->findOneBy(['id' => $id]);
        $productos = $perfil->getProductos();

        return $this->render('tienda_user/actualizar_productos.html.twig', [
            'productos' => $productos,
        ]);
    }

    #[Route('/tienda/user/{id}/editar-productos', name: 'app_tienda_editar_productos')]
    public function edit(Request $request, EntityManagerInterface $entityManager, producto $producto, productoRepository $productoRepository): Response
    {
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('app_tienda_user_profile', ['id' => $producto->getUsuario()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tienda_user/editar_producto.html.twig', [
            'producto' => $producto,
            'form' => $form,
        ]);
    }

    #[Route('/tienda/user/{id}/eliminar-productos', name: 'app_tienda_eliminar_productos')]
    public function delete(Request $request, EntityManagerInterface $entityManager, producto $producto, productoRepository $productoRepository): Response
    {

        if ($this->isCsrfTokenValid('delete'.$producto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($producto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tienda_user_profile', ['id' => $producto->getUsuario()->getId()], Response::HTTP_SEE_OTHER);
    }
}
