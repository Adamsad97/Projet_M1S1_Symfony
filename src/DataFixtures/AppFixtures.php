<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Carrier;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // USERS
        $user1 = new User();
        $user1->setEmail('diawaraad97@gmail.com');
        $user1->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user1->setPassword('$2y$13$jVXanGBQdvfoX3Sp.KC9euSd12m6sio2CMuJOXw7rW0SsQ6.qTbuq');
        $user1->setFirstname('Adama');
        $user1->setLastname('Diawara');
        $user1->setIsVerified(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('diawaraad79@gmail.com');
        $user2->setRoles([]);
        $user2->setPassword('$2y$13$RatuzFT2cxep8juiEDLRQOOykN7IGNTVg6pZNKJTJOvoCcUuFeUUm');
        $user2->setFirstname('Adama');
        $user2->setLastname('Diawara');
        $user2->setIsVerified(true);
        $manager->persist($user2);

        // CATEGORIES
        $categories = [];
        $categoryNames = ['Smartphone', 'Montre connectée', 'PC portable'];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setSlug(strtolower(str_replace(' ', '-', $name)));
            $manager->persist($category);
            $categories[] = $category;
        }

        // PRODUCTS
        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $category = $categories[array_rand($categories)];

            $product->setCategory($category);
            $product->setName($category->getName() . " modèle $i");
            $product->setSlug(strtolower($category->getSlug() . "-modele-$i"));
            $product->setDescription("Description du produit $i<br>Catégorie : " . $category->getName() . "<br>Autonomie : " . rand(10, 50) . "h");
            $product->setIllustration("products/produit{$i}.jpg"); // seulement le chemin relatif, sans /uploads
            $product->setPrice(rand(100, 1000));
            $product->setTva(20);
            $manager->persist($product);
        }

        // CARRIERS
        $carrier1 = new Carrier();
        $carrier1->setName('Colissimo');
        $carrier1->setDescription("Colissimo, rapide et fiable\nLivraison en 48h");
        $carrier1->setPrice(4.90);
        $manager->persist($carrier1);

        $carrier2 = new Carrier();
        $carrier2->setName('Chronopost');
        $carrier2->setDescription("Chronopost, livraison express\n24h en France");
        $carrier2->setPrice(9.90);
        $manager->persist($carrier2);

        // ADDRESSES
        $addresses = [
            ['Adama', 'Diawara', '182 AV. ROUGET DE LISLE', '94400', 'Vitry-sur-Seine', 'FR', '0659585811', $user1],
            ['Adama', 'Adama', '182 AV. ROUGET DE LISLE', '94400', 'Vitry-sur-Seine', 'FR', '0659585811', $user2],
            ['Adama', 'Diawara', "5 AV. DE L'ABBE ROGER DERRY", '94400', 'Vitry-sur-Seine', 'FR', '0659585811', $user1],
            ['Adama', 'Diawara', '20 Rue de Cuques', '13100', 'Aix-en-Provence', 'FR', '0668429870', $user1],
        ];

        foreach ($addresses as [$first, $last, $addr, $postal, $city, $country, $phone, $user]) {
            $adresse = new Adresse();
            $adresse->setFirstname($first);
            $adresse->setLastname($last);
            $adresse->setAdresse($addr);
            $adresse->setPostal($postal);
            $adresse->setCity($city);
            $adresse->setCountry($country);
            $adresse->setPhone($phone);
            $adresse->setUser($user);
            $manager->persist($adresse);
        }

        $manager->flush();
    }
}
