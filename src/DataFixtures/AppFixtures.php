<?php
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 10 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName('category'.$i);
            $category->setSlug(mt_rand(10, 100));
            $manager->persist($category);
        }
        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('tablette'.$i);
            $product->setSlug(mt_rand(10, 100));
            $product->setDescription('Tablette jaune'.$i);
            $product->setIllustration('image'.$i);
            $product->setPrice(mt_rand(40, 100));;
            $product->setTva(mt_rand(5, 20));;
            $product->setinHomepage('imHomePage'.$i);
            $manager->persist($product);
        }

        $manager->flush();
    }


}
