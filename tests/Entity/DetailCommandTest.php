<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 11:24
 */

namespace App\Tests\Entity;


use App\Entity\Command;
use App\Entity\DetailCommand;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class DetailCommandTest extends TestCase
{
    public function testDetailCommandEntity()
    {
        $detailCommand = new DetailCommand();
        $detailCommand->setQuantity(1);

        $command = new Command();
        $command->setNameClient('name test');

        $product = new Product();
        $product->setName('name product test');

        $detailCommand->setCommand($command);
        $detailCommand->setProduct($product);

        $this->assertEquals(1, $detailCommand->getQuantity());
        $this->assertEquals('name test', $detailCommand->getCommand()->getNameClient());
        $this->assertEquals('name product test', $detailCommand->getProduct()->getName());
    }
}