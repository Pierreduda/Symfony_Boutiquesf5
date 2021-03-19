<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\DataFixtures\BaseFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategorieFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->createMany(10, "categorie", function($num){
            $categorie = new Categorie;
            $categorie->setTitre($this->faker->word);
            $categorie->setMotsCles($this->faker->words($this->faker->randomDigit, true));
            $categorie->addProduit( $this->getRandomReference("produit"));
            return $categorie;
        });

        $manager->flush();
    }

    public function getDependencies(){
        return [ProduitFixture::class];
    }
}
