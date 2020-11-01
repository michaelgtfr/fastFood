<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 09:15
 */

namespace App\Tests\Form;


use App\Entity\DetailCommand;
use App\Entity\Product;
use App\Form\DetailForm;
use Symfony\Component\Form\Test\TypeTestCase;

class DetailFormTest extends TypeTestCase
{
    /**
     * DetailForm file test file. Tested with phpunit "./vendor/bin/simple-phpunit"
     */
    public function testBuildForm()
    {
        $data = [
            'quantity' => 1,
        ];

        $dataTwo = [
            'name' => 'test',
            'price' => 3,
            'description' => 'test description',
        ];

        $detailCommand = new DetailCommand();

        $product = new Product();
        $product->setName($dataTwo['name']);
        $product->setDescription($dataTwo['description']);
        $product->setPrice($dataTwo['price']);

        $detailCommand->setProduct($product);

        $formCommand = $this->factory->create(DetailForm::class, $detailCommand);

        $dataToCompare = new DetailCommand();
        $dataToCompare->setProduct($product);

        $formCommand->submit($data);

        $this->assertTrue($formCommand->isSynchronized());

        $this->assertEquals($detailCommand->getQuantity(), $dataToCompare->getQuantity());

        $view = $formCommand->createView();
        $children = $view->children;

        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}