<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\FormEvent;


class PasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('acuelpassword', PasswordType::class, [
                'label' => 'votre mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Obligatoire*'
                ],
                'mapped' => false,
            ])
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
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $user = $form->getConfig()->getOptions()['data'];
                $passwordHasher = $form->getConfig()->getOptions()['passwordHasher'];
                // 1. Récupération du mot de passe saisi par l'utilisateur et comparer au mot de passe stocké dans la BD
                $isValid = $passwordHasher->isPasswordValid(
                    $user,
                    $form->get('acuelpassword')->getData()
                );

            //Gestion des erreurs
                if (!$isValid)
                {
                    $form->get('acuelpassword')->addError(new FormError('Mot de passe incorrect'));
                }
                else{

                }
            })

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher' => null,
        ]);
    }
}
