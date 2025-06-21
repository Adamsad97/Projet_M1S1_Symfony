<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        //Je declare un objet form pour aller chercher le FormUserType.php
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Compte créé avec succès!',
            );

            //Envoie d'un mail de confirmation d'inscription réussie
            $mail = new Mail();
            $vars = [
                'firstname' => $user->getFirstname()
            ];
            $mail->send($user->getEmail(), $user->getFirstname().' '.$user->getLastname(), ' Beinvenu(e) sur ElecStore', 'welcome.html', $vars);

            return $this->redirectToRoute('app_login');
        }
        return $this->render('register/index.html.twig',[
            //J'appelle mon formulaire afin qu'il s'affiche ici
            'registerForm' => $form->createView()
        ]);
    }
}
