<?php
namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart{
    public function __construct(private RequestStack $requestStack)
    {

    }

    /*
     * add()
     * Fonction permettant l'ajout d'un produit au panider
     */
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

    /*
    * decrease()
    * Fonction permettant le retrait d'un produit au panider
    */

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


    /*
    * fullQuantity()
    * Fonction permettant de retourner le nombre total de produit au panier
    */
    public function fullQuantity()
    {
        // ICi, on récupère le panier ou un tableau vide si la session ne contient rien
        $cart = $this->requestStack->getSession()->get('cart', []);
        $quantity = 0;

        // Cette condition, je la commente, puisqu'elle joue le même rôle que le tableau "[]" sur la ligne qui précède $quantity = 0
        //Je l'ai commentée parce qu'elle peut me servir dans d'autre projet autre que celui-ci
        /*
         * if(!isset($cart))
        {
            return $quantity;
        }
         */

        foreach ($cart as $product) {
            $quantity += $product['quantity'];
        }
        return $quantity;
    }

    /*
    * getTotalwt()
    * Fonction permettant de retourner le montant tatal TTC de produits au panier
    */
    public function getTotalwt()
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        $price = 0;

        //Même chose que la condition définie dans la function fullQuantity, Donc, avec ce table "[]", pas besoin de faire la condition
        //Puisque le table des prix est contient déjà une valer = 0
        /*
         * f(!isset($cart))
        {
            return $price
         */

        foreach ($cart as $product)
        {
            //$price +=  $price + ($product['objet']->getPricewt() * $product['quantity']);
            $price += $product['objet']->getPricewt() * $product['quantity'];


        }

        return $price;
    }


    /*
    * remove()
    * Fonction permettant de vider complètement le panier
    */
    public function remove()
    {
        return $this->requestStack->getSession()->remove('cart');
    }

    /*
    * getCart()
    * Fonction permettant de retourner le panier
    */
    public function getCart()
    {
        return $this->requestStack->getSession()->get('cart', []);
    }

}

