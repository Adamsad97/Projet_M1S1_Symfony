<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'adresses' => $adresse,
            'action' => $this->generateUrl('app_order_summary')
        ]);

        return $this->render('order/index.html.twig', [
            'deliverForm' => $form->createView(),
        ]);
    }

    #[Route('/commande/recapitulatif', name: 'app_order_summary')]
    public function add(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        if($request->getMethod() != 'POST') {
            return $this->redirectToRoute('app_cart');
        }
        $products = $cart->getCart();
        $form = $this->createForm(OrderType::class, null, [
            //Pour afficher dans la view les adresses appartenant à user connecté et non l'ensemble des adresses dans la BD
            'adresses' => $this->getUser()->getAdresses(),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Stockage des infos en BD

            //Création de la chaine adresse
            $adresseObj = $form->get('adresses')->getData();

            $adresse = $adresseObj->getFirstname()." ".$adresseObj->getLastname().'<br/>';
            $adresse .= $adresseObj->getAdresse().'<br/>';
            $adresse .= $adresseObj->getPostal().", ".$adresseObj->getCity().'<br/>';
            $adresse .= $adresseObj->getCountry().'<br/>';
            $adresse .= $adresseObj->getPhone();


            //Céation de notre objet order
            $order = new Order();
            $order->setUser($this->getUser());
            $order->setCreatedAt(new \DateTime());
            $order->setState(1);
            $order->setCarrierName($form->get('carriers')->getData()->getName());
            $order->setCarrierPrice($form->get('carriers')->getData()->getPrice());
            $order->setDelivry($adresse);

            foreach ($products as $product)
            {
                $orderDetail = new OrderDetail();
                $orderDetail->setProductName($product['objet']->getName());
                $orderDetail->setProductIllustration($product['objet']->getIllustration());
                $orderDetail->setProductPrice($product['objet']->getPrice());
                $orderDetail->setProductTva($product['objet']->getTva());
                $orderDetail->setProductQuantity($product['quantity']);
                $order->addOrderDetail($orderDetail);
            }

            $entityManager->persist($order);
            $entityManager->flush();
        }
        return $this->render('order/summary.html.twig', [
            'choices' => $form->getData(),
            'cart' => $products,
            'order' => $order,
            'totalwt' => $cart->getTotalwt(),
        ]);
    }

}
