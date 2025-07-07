<?php

namespace App\Controller;

use App\Repository\HeaderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HeaderRepository $headerRepository, ProductRepository $productRepository, Request $request): Response
    {
        $cvUrl = $request->get('cvUrl');
        if (!$cvUrl) {
            $cvDir = $this->getParameter('cv_directory');
            $files = glob($cvDir . '/*.{pdf,doc,docx}', GLOB_BRACE);
            if ($files) {
                // Prend le fichier le plus récent
                usort($files, function($a, $b) { return filemtime($b) - filemtime($a); });
                $lastCv = basename($files[0]);
                $cvUrl = '/uploads/cv/' . $lastCv;
            }
        }
        return $this->render('home/index.html.twig', [
            'headers' => $headerRepository->findAll(),
            'productInHomepage' => $productRepository->findByInHomepage(true),
            'cvUrl' => $cvUrl,
        ]);
    }
}
