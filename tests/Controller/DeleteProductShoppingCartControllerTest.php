<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 16/11/2020
 * Time: 17:05
 */

namespace App\Tests\Controller;


use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteProductShoppingCartControllerTest extends WebTestCase
{
    use FixturesTrait;

    private $fixtures;

    protected function dataFixture()
    {
        $this->fixtures = $this->loadFixtures([
            AppFixtures::class,
        ])->getReferenceRepository();
    }

    public function testDeleteProductShoppingCart()
    {
        $client = static::createClient();

        $this->dataFixture();
        $id = $this->fixtures->getReference('addInOrderBasketController')->getId();

        $client->xmlHttpRequest('POST', '/deleteProductShoppingCart', ['id' => $id]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}