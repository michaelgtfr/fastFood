<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 17:21
 */

namespace App\Tests\Controller;


use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandControllerTest extends WebTestCase
{
    use FixturesTrait;

    protected function dataFixture()
    {
        $this->loadFixtures([
            AppFixtures::class,
        ]);
    }

    public function testDisplayOfTheCommandPage()
    {
        $client = static::createclient();
        $this->dataFixture();

        $crawler = $client->request('GET', '/command');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Les produits:', $crawler->filter('h1')->text());
    }
}