<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ResetPasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Votre nouveau mot de passe',
                    'hash_property_path' => 'password',
                    'attr' => ['placeholder' => 'Obligatoire*'],
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Length(min: 4, max: 30),
                         new Assert\Regex([
                            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@£§!#&\?\*]).+$/',
                            'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial (@, £, §, !, #, &, ?, *)',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer votre nouveau  mot de passe',
                    'attr' => ['placeholder' => 'Obligatoire*'],
                    'constraints' => [
                       new Assert\NotBlank(),
                        new Length(min: 4, max: 30),
                         new Assert\Regex([
                            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@£§!#&\?\*]).+$/',
                            'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial (@, £, §, !, #, &, ?, *)',
                        ]),
                    ],
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour mon mot de passe',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'data_class' => User::class,
        ]);
    }
}
