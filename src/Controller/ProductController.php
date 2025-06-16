<?php

namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/produit/{slug}', name: 'app_product')]
    public function index($slug, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneBySlug($slug);

        //Redirection sur la home_page si l'utilisateur une url de produit qui n'existe pas
        if(!$product){
            return $this->redirectToRoute('app_home');
        }
        return $this->render('product/index.html.twig', [
            'product' => $product,

        ]);
    }
}
