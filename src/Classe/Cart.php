<?php
namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart{
    public function __construct(private RequestStack $requestStack)
    {

    }
    public function add($product)
    {
        //Appel de la session de symfony
        $cart = $this->requestStack->getSession()->get('cart');

        //Ajout de quantité+1 à mon produit
        $cart = $this->requestStack->getSession()->get('cart', []); // valeur par défaut : tableau vide

        if (isset($cart[$product->getId()])) {
            $cart[$product->getId()] = [
                'objet' => $product,
                'quantity' => $cart[$product->getId()]['quantity'] + 1
            ];

        } else {
            $cart[$product->getId()] = [
                'objet' => $product,
                'quantity' => 1
            ];
        }


        //Créer de ma session Cart (panier)
        $this->requestStack->getSession()->set('cart', $cart);
    }

  //Fonction pour diminuer la quantité dans le panier

    public function decrease($id)
    {
        $cart = $this->requestStack->getSession()->get('cart');
        if($cart[$id]['quantity'] > 1)
        {
            $cart[$id]['quantity'] = $cart[$id]['quantity']-1;
        }
        else{
            unset($cart[$id]);
        }
        $this->requestStack->getSession()->set('cart', $cart);
    }

//Fonction pour vider le panier
    public function remove()
    {
        return $this->requestStack->getSession()->remove('cart');
    }

    public function getCart()
    {
        return $this->requestStack->getSession()->get('cart');
    }

}

