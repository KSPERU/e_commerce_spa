<?php

namespace App\Twig\Components;

use App\Form\ProductoType;
use App\Entity\Producto\producto;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent("producto_editar", template: 'components/producto_editar.html.twig')]
class ProductoEditarComponent extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?producto $producto;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            ProductoType::class,
            $this->producto
        );
    }
}