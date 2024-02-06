<?php

namespace App\Form;

use App\Entity\Usuario\usuario;
use App\Entity\Producto\producto;
use App\Entity\Descuento\descuento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pr_nombre', TextType::class, [
                'label' => 'Nombre del Producto',
            ])
            ->add('pr_categoria', TextType::class, [
                'label' => 'Categoría',
            ])
            ->add('pr_stock', IntegerType::class, [
                'label' => 'Stock',
            ])
            ->add('pr_precio', NumberType::class, [
                'label' => 'Precio',
            ])
            ->add('pr_categoria', TextType::class, [
                'label' => 'Categoría',
            ])
            ->add('pr_descripcion', TextareaType::class, [
                'label' => 'Descripción',
                'required' => false,
            ])
            //En el figma de frontend sale un campo de tiempo de entrega a tener en cuenta
            // ->add('descuento', EntityType::class, [
            //     'class' => descuento::class,
            //     'choice_label' => 'id',
            // ])
            ->add('Agregar', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => producto::class,
        ]);
    }
}
