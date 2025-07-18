<?php

namespace App\Controller\Account;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/compte/commande/{id_order}', name: 'app_account_order')]
    public function index($id_order, OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->find($id_order);

        if (!$order) {
            return $this->redirectToRoute('app_home');
        }

        // Vérification d'accès avec le voter
        $this->denyAccessUnlessGranted('ORDER_VIEW', $order);

        return $this->render('account/order/index.html.twig', [
            'order' => $order,
        ]);
    }
}
