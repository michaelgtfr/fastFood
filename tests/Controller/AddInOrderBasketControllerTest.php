<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 20:29
 */

namespace App\Tests\Controller;


use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddInOrderBasketControllerTest extends WebTestCase
{
    use FixturesTrait;

    private $fixtures;

    protected function dataFixture()
    {
        $this->fixtures = $this->loadFixtures([
            AppFixtures::class,
        ])->getReferenceRepository();
    }

    public function testAddInOrderBasket()
    {
        $client = static::createClient();

        $this->dataFixture();
        $id = $this->fixtures->getReference('addInOrderBasketController')->getId();

        $client->xmlHttpRequest('POST', '/addShoppingCart', ['id' => $id, 'quantity' => 2]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}