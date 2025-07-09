<?php

namespace App\Controller\Account;

use App\Classe\Cart;
use App\Entity\Adresse;
use App\Form\AdresseUserType;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class AdresseController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    //Route pour lister les adresses
    #[Route('/compte/adresses', name: 'app_account_adresses')]
    public function index(): Response
    {
        return $this->render('account/adresse/index.html.twig');
    }

    //Suppression d'adresse
    #[Route('/compte/adresses/delete/{id}', name: 'app_account_adresses_delete')]
    public function delete($id, AdresseRepository $adresseRepository): Response
    {
        $adresse = $adresseRepository->findOneById($id);
        if(!$adresse OR $adresse->getUser() !== $this->getUser())
        {
            return $this->redirectToRoute('app_account_adresses');
        }
        $this->entityManager->remove($adresse);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_account_adresses');
    }

    //Route permettant d'ajouter une nouvelle adresse et la modifier
    #[Route('/compte/adresse/ajouter/{id}', name: 'app_account_adresse_form', defaults:['id' => null] )]
    public function form(Request $request, $id, AdresseRepository $adresseRepository, Cart $cart): Response
    {
        if($id)
        {
            $adresse = $adresseRepository->findOneById($id);
            //vérification si l'adresse appartient à l'utilisateur
            if(!$adresse OR $adresse->getUser() !== $this->getUser())
            {
                return $this->redirectToRoute('app_account_adresses');
            }
        }else{
            $adresse = new Adresse();
            $adresse->setUser($this->getUser());
        }


        $form = $this->createForm(AdresseUserType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();

            /*
             *  $this->addFlash(
                success',
                'Adresse ajoutée avec succès!',
                );
             */

            if($cart->fullQuantity() > 0)
            {
                return $this->redirectToRoute('app_order');
            }
            return $this->redirectToRoute('app_account_adresses');
        }

        return $this->render('account/adresse/form.html.twig', [
            'adresseForm' => $form->createView()
        ]);
    }
}
?>
