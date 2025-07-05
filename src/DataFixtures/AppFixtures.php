<?php
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Carrier;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Catégories
        $category1 = new Category();
        $category1->setName('SmartPhone');
        $category1->setSlug('smartphone');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Montre connectée');
        $category2->setSlug('montre-connectee');
        $manager->persist($category2);

        // Produits
        $product1 = new Product();
        $product1->setCategory($category2);
        $product1->setName('Montre connectée');
        $product1->setSlug('montre-connectee');
        $product1->setDescription('<div>Montre connecté<br>Couleur : Gris<br>Autonomie : 48h<br><br></div>');
        $product1->setIllustration('2025-07-03-626b7034cdbf7df74157e850677815d69a75638c.jpg');
        $product1->setPrice(130);
        $product1->setTva(20);
        $product1->setinHomepage(0);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setCategory($category1);
        $product2->setName('Smartphone');
        $product2->setSlug('smartphone');
        $product2->setDescription('<div>Iphone 16<br>Couleur : Rose<br>Autonomie : 26h</div>');
        $product2->setIllustration('2025-07-03-748a499dfd2c63cb00dc6452a2ce390e4492eebf.jpg');
        $product2->setPrice(900);
        $product2->setTva(10);
        $product2->setinHomepage(0);
        $manager->persist($product2);

        // Carrier
        $carrier1 = new Carrier();
        $carrier1->setName('Colissimo');
        $carrier1->setDescription("Colissimo, Rapide et fiable\nDurée max : 48h\nPartout en France");
        $carrier1->setPrice(4.9);
        $manager->persist($carrier1);

        $carrier2 = new Carrier();
        $carrier2->setName('Chronopost');
        $carrier2->setDescription("Transporteur sécurisé\nMax : 24h\nPartout en France");
        $carrier2->setPrice(9.9);
        $manager->persist($carrier2);

        // Utilisateur
        $user = new User();
        $user->setEmail('diawaraad97@gmail.com');
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setFirstname('Adama');
        $user->setLastname('Diawara');
        $user->setIsVerified(true);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $manager->flush();
    }
}
