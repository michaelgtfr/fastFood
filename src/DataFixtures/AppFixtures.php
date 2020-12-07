<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('name test');
        $product->setDescription('description test');
        $product->setDesignation(1);
        $product->setAvailability(1);
        $product->setPrice('2');

        $this->setReference('addInOrderBasketController', $product);

        $manager->persist($product);

        $manager->flush();
    }
}
