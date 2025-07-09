<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Commande')
            ->setEntityLabelInPlural('Gestion des Commandes');
            // ...;
    }





    //Gestion des boutons (options) Créer, Modifier, Supprimer afin que l'admin
    //ne puisse ne créer, ni modifier, ni supprimer une commande. Mais plutôt la possibilité
    // d'afficher les détails des commandes

    public function configureActions(Actions $actions): Actions
    {
        $show = Action::new('Afficher', 'Afficher')
            ->linkToRoute('admin_order_show', function (Order $order) {
                return ['id' => $order->getId()];
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $show)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }

    #[Route('/admin/order/{id}/show', name: 'admin_order_show')]
    public function show(Order $order): Response
    {
        return $this->render('admin/order.html.twig', [
            'order' => $order,
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateField::new('createdAt', 'Date de commande'),
            NumberField::new('state', 'Statut')->setTemplatePath('admin/state.html.twig'),
            AssociationField::new('user', 'Client'),
            TextField::new('carrierName', 'Transporteur'),
            NumberField::new('totalTva', 'Total Tva'),
            NumberField::new('totalwt', 'Total T.T.C'),

        ];
    }





}
