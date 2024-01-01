<?php

namespace App\Form;

use App\Entity\Usuario\usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('u_correo', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                    new Email([
                        'message' => 'The email "{{ value }}" is not a valid email.',
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'The email cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('u_nombres', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your first name',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'The first name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('u_apepat', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your paternal last name',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'The paternal last name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('u_apemat', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your maternal last name',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'The maternal last name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('u_dni', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your DNI',
                    ]),
                    new Regex([
                        'pattern' => '/^\d{8}$/',
                        'message' => 'The DNI must contain exactly 8 digits.',
                    ]),
                ],
            ])
            ->add('u_telefono', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{9}$/',
                        'message' => 'The DNI must contain exactly 9 digits.',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => usuario::class,
        ]);
    }
}
