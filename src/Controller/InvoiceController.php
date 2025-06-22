<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InvoiceController extends AbstractController
{
    /*
     * Impression facture PDF pour un user connecté
     * Vérification de la commande pour un user donné
     */
    #[Route('/compte/facture/impression/{id_order}', name: 'app_invoice_customer')]
    public function index(OrderRepository $orderRepository, $id_order): Response
    {
        // 1. Vérifiacation de l'objet commande(order) - Existe ?
        $order = $orderRepository->findOneById($id_order);
        if (!$order) {
            return $this->redirectToRoute('app_account');
        }

        // 2. Vérifiacation de l'objet commande(order) - OK pour le user
        if($order->getUser() != $this->getUser())
        {
            return $this->redirectToRoute('app_account');
        }
        $dompdf = new Dompdf();
        $html = $this->renderView('invoice/index.html.twig', [
            'order' => $order,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('facture.pdf', [
            "Attachment" => false
        ]);
        exit();


    }
}
