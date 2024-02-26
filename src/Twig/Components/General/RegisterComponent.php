<?php

namespace App\Twig\Components\General;

use App\Entity\Usuario\usuario;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(template: 'frontend/tiendaks/general/componentes/register_component.html.twig')]
class RegisterComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?array $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $form = $this->createForm(RegistrationFormType::class, $this->initialFormData);
        return $form;
    }

    #[LiveAction]
    public function guardar(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->submitForm();

        /** @var usuario $usuario */
        $usuario = $this->getForm()->getData();
        $clave = $this->getForm()->get('plainPassword')->getData();
        $usuario->setPassword(
            $userPasswordHasher->hashPassword(
                $usuario,
                $clave
            )
        );
        $usuario->setUEstado(true);
        $entityManager->persist($usuario);
        $entityManager->flush();

        $this->addFlash('success', 'Registrado!');
        return $this->redirectToRoute('app_frontend_inicio_mostrar_inicio');
    }
}