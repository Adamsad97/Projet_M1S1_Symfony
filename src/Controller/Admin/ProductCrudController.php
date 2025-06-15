<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Gestion des Produits')
            // ...
            ;
    }



    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name', 'Nom du produit'),
            SlugField::new('slug', 'URL')->setTargetFieldName('name')->setHelp("URL de votre produit créée automatiquement"),
            TextEditorField::new('description', 'Description')->setHelp("Description de votre produit"),
            ImageField::new('illustration', 'Image')->setHelp("Image du peoduit en 600x600px")->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')->setBasePath('/uploads')->setUploadDir('public/uploads'),
            NumberField::new('price', 'Prix H.T')->setHelp("Prix sans le sigle €"),
            ChoiceField::new('tva', 'TVA')->setChoices([
                '5,5%' => '5.5',
                '10%' => '10',
                '20%' => '20'
            ]),

            //Affichage des catégorie dispo

            AssociationField::new('category', 'Categorie associée')

        ];
    }

}
