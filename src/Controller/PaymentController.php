<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PaymentController extends AbstractController
{
    #[Route('/commande/paiement/{id_order}', name: 'app_payment')]
    public function index($id_order, OrderRepository $orderRepository, EntityManagerInterface $entityManager): Response
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);


        $order = $orderRepository->findOneBy([
            'id' => $id_order,
            'user' => $this->getUser(),

        ]);

        if(!$order){
            return $this->redirectToRoute('app_home');
        }

        foreach($order->getOrderDetails() as $product)
        {
            $product_for_stripe[] =[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => number_format($product->getProductPricewt()*100, 0, '', ''),
                    'product_data' => [
                        'name' => $product->getProductName(),
                        'images' => [
                            $_ENV['DOMAIN'].'/uploads/'.$product->getProductIllustration(),
                        ]
                    ]
                ],
                'quantity' => $product->getProductQuantity(),
            ];
        }

        $product_for_stripe[] =[
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => number_format($order->getCarrierPrice()*100, 0, '', ''),
                'product_data' => [
                    'name'=> 'Transporteur :'.$order->getCarrierName(),
                    ]
                ],
            'quantity' => 1,
        ];



        $checkout_session = Session::create([
            //cette ligne permet de saisir automatiquement l'adresse email de user actif qui est par defaut enrégistré
            //Mais je la commente puisque c'est pour un environnement de test
            //'customer_email' => $this->getUser()->getEmail(),
            'line_items' => [[
                $product_for_stripe
            ]],
            'mode' => 'payment',
            'success_url' => $_ENV['DOMAIN'] . '/commande/merci/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $_ENV['DOMAIN'] . '/mon-panier/annulation',
        ]);

        $order->setStripeSessionId($checkout_session->id);
        $entityManager->flush();
        return $this->redirect($checkout_session->url);

    }

    #[Route('/commande/merci/{stripe_session_id}', name: 'app_payment_success')]
    public function success($stripe_session_id, OrderRepository $orderRepository, EntityManagerInterface $entityManager, Cart $cart): Response
    {
        $order = $orderRepository->findOneBy([
            'stripe_session_id' => $stripe_session_id,
            'user' => $this->getUser(),
        ]);
        if(!$order){
            return $this->redirectToRoute('app_home');
        }
        if($order->getState() == 1)
        {
            $order->setState(2);
            $cart->remove();
            $entityManager->flush();

            // Envoi de l'email de confirmation
            $mail = new Mail();
            $user = $this->getUser();
            $orderDetails = '';
            foreach ($order->getOrderDetails() as $detail) {
                $orderDetails .= $detail->getProductName() . ' x' . $detail->getProductQuantity() . ' - ' . number_format($detail->getProductPricewt(), 2, ',', ' ') . '€ TTC<br/>';
            }
            $mail->send(
                $user->getEmail(),
                $user->getFirstname(),
                'Confirmation de votre commande',
                'order_confirmation.html',
                [
                    'firstname' => $user->getFirstname(),
                    'order_details' => $orderDetails
                ]
            );
        }

        return $this->render('payment/success.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/commande/annulation/{id}', name: 'app_order_cancel')]
    public function cancel($id, OrderRepository $orderRepository, EntityManagerInterface $entityManager): Response
    {
        $order = $orderRepository->findOneBy([
            'id' => $id,
            'user' => $this->getUser(),
        ]);
        if (!$order || $order->getState() !== 2) { // Annulation possible seulement si payé mais pas encore traité
            return $this->redirectToRoute('app_account_order');
        }
        $order->setState(5); // 5 = Annulée
        $entityManager->flush();
        $mail = new \App\Classe\Mail();
        $user = $this->getUser();
        $mail->send(
            $user->getEmail(),
            $user->getFirstname(),
            'Confirmation d\'annulation de votre commande',
            'order_cancelled.html',
            [
                'firstname' => $user->getFirstname(),
                'order_id' => $order->getId()
            ]
        );
        $this->addFlash('success', 'Votre commande a bien été annulée.');
        return $this->redirectToRoute('app_account_order', ['id_order' => $order->getId()]);
    }

}
