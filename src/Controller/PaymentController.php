<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PaymentController extends AbstractController
{
    #[Route('/command/paiement/{id_order}', name: 'app_payment')]
    public function index($id_order, OrderRepository $orderRepository): Response
    {
        Stripe::setApiKey('sk_test_51RbX6LPsyRkwdLsT5iBY6OhpLFuPmAVFpV8kzhdnqq0h3NTzzh0Rasx2QydaVMrz2uUZ8ausyAmYZDPusBceRrQV00H5wBd2Yi');
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';

        $order = $orderRepository->findOneById($id_order);
        $product_for_stripe = [];
        foreach($order->getOrderDetails() as $product)
        {
            $product_for_stripe[] =[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => number_format($product->getProductPricewt()*100, 0, '', ''),
                    'product_data' => [
                        'name' => $product->getProductName(),
                        'images' => [
                            $YOUR_DOMAIN.'/uploads/'.$product->getProductIllustration(),
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
            'line_items' => [[
                $product_for_stripe
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        //header("HTTP/1.1 303 See Other");
        //header("Location: " . $checkout_session->url);

        return $this->redirect($checkout_session->url);

        die('Ok');
    }
}
