<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ForgotPasswordFormType;
use App\Form\ResetPasswordFormType;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ForgotPasswordController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/mot-de-passe-oublie', name: 'app_password')]
    public function index(Request $request, UserRepository $repository): Response
    {
             // 1. Formulaire
        $form = $this->createForm(ForgotPasswordFormType::class);
        $form->handleRequest($request);
            // 2. Traitement du formulaire
        if($form->isSubmitted() && $form->isValid()) {

            // 3. Si l'email renseigné par user est en basee de données
            $email = $form->get('email')->getData();

            $user = $repository->findOneByEmail($email);

            // 4. Envoyer une notification à l'utilisateur
            $this->addFlash('success', "Si votre adresse email est existe, vous recevrez un mail pour réinitialiser votre mot de passe.");

            // 5. Si c'est USER existe, on reset le mot de password, et on envoie par mail le nouveau password
            if($user) {
                $token = bin2hex(random_bytes(32));
                $user->setToken($token);

                $date = new DateTime();
                $date->modify('+10 minutes');

                $user->setTokenExpireAt($date);

                $this->em->flush();

                //$url = $this->generateUrl('app_password_update', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                //Envoie d'un mail de réinitialisation de mot de passe
                $mail = new Mail();
                $vars = [
                    'link' => $this->generateUrl('app_password_update', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL),
                ];
                $mail->send($user->getEmail(), $user->getFirstname().' '.$user->getLastname(), 'Réinitialisation de votre mot de passe', 'forgotpassword.html', $vars);


            }
            // 6. Si aucun email trouvéé, n push une notification: Email introuvable
        }

        return $this->render('password/index.html.twig', [
            'forgotPasswordForm' => $form->createView(),
        ]);
    }



    #[Route('/mot-de-passe/reset/{token}', name: 'app_password_update')]
    public function update(Request $request, UserRepository $userRepository, $token): Response
    {
        if(!$token)
        {
           return $this->redirectToRoute('app_password');
        }
        $user = $userRepository->findOneByToken($token);

        $now = new DateTime();

        if(!$user || $now > $user->getTokenExpireAt()){
            return $this->redirectToRoute('app_password');
        }

        $form = $this->createForm(ResetPasswordFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user->setToken(null);
            $user->setTokenExpireAt(null);
            $this->em->flush();
            $this->addFlash(
                'success',
                'Votre mot de passe a été mis à jour avec succès!',
            );
            return $this->redirectToRoute('app_login');
        }
        return $this->render('password/reset.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
