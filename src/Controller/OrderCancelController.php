<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use App\Classe\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class OrderCancelController extends AbstractController
{
    #[Route('/account/order/{id}/cancel', name: 'app_account_order_cancel')]
    #[IsGranted('ROLE_USER')]
    public function cancel(Order $order, EntityManagerInterface $em): RedirectResponse
    {
        if ($order->getUser() !== $this->getUser()) {
            $this->addFlash('danger', 'Accès refusé.');
            return $this->redirectToRoute('app_account_order', ['id_order' => $order->getId()]);
        }
        if ($order->getState() !== 2) {
            $this->addFlash('warning', 'La commande ne peut plus être annulée.');
            return $this->redirectToRoute('app_account_order', ['id_order' => $order->getId()]);
        }
        $order->setState(5); // 5 = Annulée
        $em->flush();

        // Envoi du mail de confirmation d'annulation
        $user = $order->getUser();
        $mail = new Mail();
        $mail->send(
            $user->getEmail(),
            $user->getFirstname(),
            'Confirmation d\'annulation de votre commande',
            'order_cancel.html',
            [
                'firstname' => $user->getFirstname(),
                'order_id' => $order->getId()
            ]
        );

        $this->addFlash('danger', 'Commande annulée avec succès. Un email de confirmation vous a été envoyé.');
        return $this->redirectToRoute('app_account_order', ['id_order' => $order->getId()]);
    }
}
