<?php

namespace App\Controller\Account;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WishlistController extends AbstractController
{
    #[Route('/compte/liste-de-souhait', name: 'app_account_wishlist')]
    public function index(): Response
    {
        return $this->render('account/wishlist/index.html.twig');
    }

    #[Route('/compte/liste-de-souhait/add/{id}', name: 'app_account_wishlist_add')]
    public function add(ProductRepository $productRepository,EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        // 1. récpérer l'objet du produit souhaité
        $product = $productRepository->findOneById($id);

        // 2. Si produit esxistant, ajouter le  produit à la whishlist
        if($product)
        {
            $this->getUser()->addWishlists($product);

            // 3. Sauvegarder en base de données
            $entityManager->flush();
        }
       // $this->addFlash('success', 'Produit ajouté à votre liste de souhait.');
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/compte/liste-de-souhait/remove/{id}', name: 'app_account_wishlist_remove')]
    public function remove(ProductRepository $productRepository,EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        // 1. récpérer l'objet du produit à supprimer
        $product = $productRepository->findOneById($id);

        // 2. Si produit esxistant, supprimer le produit de la whishlist
        if($product)
        {
            //$this->addFlash('success', 'Produit supprimer de votre liste de souhait avec succes.');
            $this->getUser()->removeWishlists($product);

            // 3. Sauvegarder en base de données
            $entityManager->flush();
        }
        else
        {
            $this->addFlash('danger', 'produit introuvable');
        }
        return $this->redirect($request->headers->get('referer'));
    }

}
