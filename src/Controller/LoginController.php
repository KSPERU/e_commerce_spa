<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, Request $request): Response
{
    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    // // If it's an AJAX request triggered by the modal, return only the modal content
    // if ($request->isXmlHttpRequest()) {
    //     // Ensure last_username is always set for the modal
    //     if (!$lastUsername) {
    //         $lastUsername = $request->get('last_username', ''); // Intenta obtenerlo de la solicitud AJAX
    //     }

    //     return $this->render('login/index.html.twig', [
    //         'last_username' => $lastUsername,
    //         'error'         => $error,
    //         'modal'         => true, // Indica que se está utilizando en un modal
    //     ]);
    // }
    // If it's a regular request, render the full page
    return $this->render('login/index.html.twig', [
        'last_username' => $lastUsername,
        'error'         => $error,
        'modal'         => false, // No es un modal en este caso
    ]);
}

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Este método puede ser invisible, ¡será interceptado por la llave de cierre en tu firewall como un ninja de la ciberseguridad!');
    }
}
