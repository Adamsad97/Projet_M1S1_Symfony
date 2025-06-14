<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=>'Votre prénom',
                'attr' => [
                    'placeholder' => 'Obligatoire*'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 30,
                    ])
                ]

            ])
            ->add('lastname', TextType::class, [
                'label'=>'Votre nom de famille',
                'attr' => [
                    'placeholder' => 'Obligatoire*'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 30,
                    ])
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Votre adresse email',
                'attr' => [
                    'placeholder' => 'Obligatoire*'
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Votre mot de passe',
                    'hash_property_path' => 'password',
                    'attr' => ['placeholder' => 'Obligatoire*'],
                    'constraints' => [
                        new Length([
                            'min' => 4,
                            'max' => 30,
                        ])
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => ['placeholder' => 'Obligatoire*'],
                    'constraints' => [
                        new Length([
                            'min' => 4,
                            'max' => 30,
                        ]),
                    ]
                ],
                 'mapped' => false,
            ])





            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //Contrainte d'unicité d'adresse mail
            'constraints' => [
                new UniqueEntity([
                    'entityClass' => User::class,
                    'fields' => ['email'],
                ])
            ],
            'data_class' => User::class,
        ]);
    }
}

