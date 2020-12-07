<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 16:15
 */

namespace App\Tests\Entity;


use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductEntity()
    {
        $product = new Product();
        $product->setName('name test');
        $product->setDescription('description test');
        $product->setPrice(2);
        $product->setDesignation(1);
        $product->setAvailability(1);

        $this->assertEquals('name test', $product->getName());
        $this->assertEquals('description test', $product->getDescription());
        $this->assertEquals(2, $product->getPrice());
        $this->assertEquals(1, $product->getDesignation());
        $this->assertEquals(1, $product->getAvailability());
    }

}