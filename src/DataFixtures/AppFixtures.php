<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

         // create 40 products! Bam!
         for ($i = 0; $i < 40; $i++) {
            $recipe = new Recipe();
            $recipe->setTitle('product '.$i);
            $recipe->setDescription(mt_rand(10, 100));
            $recipe->setPicture('product '.$i);
            $recipe->setServings('product '.$i);
            $recipe->setPrivate('product '.$i);
            $recipe->addCategory('product '.$i);

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
