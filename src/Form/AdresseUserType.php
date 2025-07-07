<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Obligatoire*',
                    'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                ]
            ])

            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Obligatoire*',
                    'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                ]
            ] )

            ->add('adresse', TextType::class, [
                'label' => 'Adresse complet',
                'attr' => [
                    'placeholder' => 'Obligatoire*',
                    'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                ]
            ])

            ->add('postal', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Obligatoire*',
                    'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                ]
            ])
            ->add('city',
                TextType::class, [
                    'label' => 'Ville',
                    'attr' => [
                        'placeholder' => 'Obligatoire*',
                        'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                    ]
                ])
            ->add('country',CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                ]
            ])
            ->add('phone',TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Obligatoire*',
                    'class' => 'w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition px-4 py-1 bg-gray-200'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => [
                    'class' => 'bg-green-800 hover:bg-green-950 text-white font-bold py-2 px-8 rounded-2xl shadow transition cursor-pointer w-full md:w-auto'
                ]
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
