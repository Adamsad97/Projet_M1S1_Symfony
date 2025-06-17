<?php

namespace App\Controller;

use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    /*
     * 1ère étape du tunnel d'achat
     * Choix de l'adresse de livraison et du transporteur
     */
    #[Route('/commande/livraison', name: 'app_order')]
    public function index(): Response
    {   $adresse = $this->getUser()->getAdresses();

        if(count($adresse) == 0){
            return $this->redirectToRoute('app_account_adresse_form');
        }
        $form = $this->createForm(OrderType::class, null, [
            //Pour afficher dans la view les adresses appartenant à user connecté et non l'ensemble des adresses dans la BD
            'adresses' => $adresse
        ]);

        return $this->render('order/index.html.twig', [
            'deliverForm' => $form->createView(),
        ]);
    }
}
