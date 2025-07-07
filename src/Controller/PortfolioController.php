<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PortfolioController extends AbstractController
{
    #[Route('/upload-cv', name: 'upload_cv', methods: ['POST'])]
    public function uploadCv(Request $request): Response
    {
        $cvFile = $request->files->get('cv_file');
        $cvUrl = null;

        if ($cvFile) {
            $newFilename = uniqid().'.'.$cvFile->guessExtension();
            $cvFile->move($this->getParameter('cv_directory'), $newFilename);
            $cvUrl = '/uploads/cv/'.$newFilename;
        }

        // Redirige vers la page d'accueil avec le lien du CV
        return $this->redirectToRoute('app_home', ['cvUrl' => $cvUrl]);
    }
}
