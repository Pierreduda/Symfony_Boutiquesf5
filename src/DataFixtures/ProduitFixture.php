<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Produit;
use App\DataFixtures\BaseFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProduitFixture extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->createMany(50, "produit", function($num){
            $produit = new Produit;
            $produit->setTitre("produit$num");
            $produit->setPrix($this->faker->randomFloat(2, 1, 190));
            $produit->setStock($this->faker->randomNumber(3));
            $produit->setCouleur($this->faker->colorName);
            $produit->setPhoto($produit->getTitre() . time() . ".jpg");
            return $produit;
        });

        $manager->flush();
    }
}
