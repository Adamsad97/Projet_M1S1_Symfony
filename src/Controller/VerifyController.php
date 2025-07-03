<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VerifyController extends AbstractController
{
    #[Route('/verify/{token}', name: 'app_verify_email')]
    public function verify(string $token, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['token' => $token]);
        if (!$user || $user->isVerified()) {
            $this->addFlash('danger', 'Lien de vérification invalide ou déjà utilisé.');
            return $this->redirectToRoute('app_login');
        }
        $user->setIsVerified(true);
        $user->setToken(null);
        $entityManager->flush();
        $this->addFlash('success', 'Votre compte a été vérifié avec succès !');
        return $this->redirectToRoute('app_login');
    }
}
