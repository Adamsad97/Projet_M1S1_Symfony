<?php
namespace App\Controller;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
            // Générer un token de vérification unique
            $token = bin2hex(random_bytes(32));
            $user->setToken($token);
            $user->setIsVerified(false);

            $entityManager->persist($user);
            $entityManager->flush();

            // Envoi du mail de vérification
            $mail = new Mail();
            $vars = [
                'firstname' => $user->getFirstname(),
                // Génère une URL absolue locale pour le mail de vérification
                'verify_url' => $this->generateUrl('app_verify_email', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
            $mail->send(
                $user->getEmail(),
                $user->getFirstname().' '.$user->getLastname(),
                'Vérifiez votre adresse email',
                'verify.html',
                $vars
            );

            $this->addFlash(
                'success',
                'Un email de vérification vous a été envoyé. Veuillez vérifier votre boîte de réception.'
            );
            return $this->redirectToRoute('app_login');
        }
        return $this->render('register/index.html.twig',[
            //J'appelle mon formulaire afin qu'il s'affiche ici
            'registerForm' => $form->createView()
        ]);
    }
}
