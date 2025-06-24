<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Gestion des Utilisateurs')
            // ...
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom de famille'),
            ChoiceField::new('roles', 'Permissions')->setHelp('Vous pouvez choisir le rôle de cet utilisateur.')->setChoices([
                'ROLE_USER' => 'ROLE_USER',
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                //'ROLE_BANNED' => 'ROLE_BANNED',
            ])->allowMultipleChoices(),
            TextField::new('email', 'Email')->OnlyOnIndex(),

        ];
    }

}
