<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 10:43
 */

namespace App\Tests\Entity;


use App\Entity\Command;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testCommandEntity()
    {
        $command = new Command();
        $date = new \DateTime();

        $command->setCellphoneNumber('0200000000');
        $command->setDateCommand($date);
        $command->setDateWish($date);
        $command->setNameClient('nametest');
        $command->setSituation('1');

        $this->assertEquals('0200000000', $command->getCellphoneNumber());
        $this->assertEquals($date, $command->getDateCommand());
        $this->assertEquals($date, $command->getDateWish());
        $this->assertEquals('nametest', $command->getNameClient());
        $this->assertEquals('1', $command->getSituation());
    }
}