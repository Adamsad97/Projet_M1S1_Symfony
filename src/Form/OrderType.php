<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresses', EntityType::class, [
                'label' => 'Choisissez votre adresse de livraison',
                'required' => true,
                'class' => Adresse::class,
                'expanded' => true,
                'choices' => $options['adresses'],
                'label_html' => true,
                'row_attr' => ['class' => 'mb-4 bg-gray-50 rounded-lg p-4 border border-gray-100'],
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-2'],
                'attr' => [
                    'class' => 'flex flex-col gap-2',
                ],
                'choice_attr' => function() {
                    return [
                        'class' => 'appearance-none w-4 h-4 align-middle rounded-full border border-gray-300 ring-1 ring-gray-300 checked:bg-blue-600 checked:ring-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition cursor-pointer',
                        'style' => 'box-shadow:none;',
                    ];
                },
            ])

            ->add('carriers', EntityType::class, [
                'label' => 'Choisissez votre transporteur',
                'required' => true,
                'class' => Carrier::class,
                'expanded' => true,
                'label_html' => true,
                'row_attr' => ['class' => 'mb-4 bg-gray-50 rounded-lg p-4 border border-gray-100'],
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-2'],
                'attr' => [
                    'class' => 'flex flex-col gap-2',
                ],
                'choice_attr' => function() {
                    return [
                        'class' => 'appearance-none w-4 h-4 align-middle rounded-full border border-gray-300 ring-1 ring-gray-300 checked:bg-blue-600 checked:ring-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition cursor-pointer',
                        'style' => 'box-shadow:none;',
                    ];
                },
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition duration-150 ease-in-out mt-4 cursor-pointer'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'adresses' => null,
        ]);
    }
}
