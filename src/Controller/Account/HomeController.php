<?php

namespace App\Controller\Account;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//Route pour afficher le compte
final class HomeController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([
            'user' => $this->getUser(),
        ], [
            'createdAt' => 'DESC'
        ]);
        $orders = array_filter($orders, function($order) {
            return $order->getState() !== 1;
        });
        return $this->render('account/index.html.twig', [
            'orders' => $orders,
        ]);
    }
}
