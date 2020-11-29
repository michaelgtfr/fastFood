<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 29/11/2020
 * Time: 08:33
 */

namespace App\Tests\Controller;


use App\DataFixtures\AppFixtures;
use App\Entity\DetailCommand;
use App\Entity\Product;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SummaryAndOrderingInformationControllerTest extends WebTestCase
{
    use FixturesTrait;

    private $fixtures;

    protected function dataFixture()
    {
        $this->fixtures = $this->loadFixtures([
            AppFixtures::class,
        ])->getReferenceRepository();
    }

    protected function getMockData($id)
    {
        $session = self::$container->get('session');

        $detailCommand = new DetailCommand();

        $product = self::$container->get('doctrine')->getRepository(Product::class)->find($id);
        $detailCommand->setProduct($product);
        $detailCommand->setQuantity(2);

        $products[$id] = $detailCommand;
        $session->set('products', $products);
        $session->save();
    }

    public function testDisplayPageSummaryAndOrderingInformation()
    {
        $client = static::createClient();

        $this->dataFixture();
        $idProduct = $this->fixtures->getReference('addInOrderBasketController')->getId();

        $this->getMockData($idProduct);

        $crawler = $client->request('GET', '/additionalinformation');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Récapitulatif de la commande', $crawler->filter('h3')->text());
        $this->assertSame($this->fixtures->getReference('addInOrderBasketController')->getName(),
            $crawler->filter('div.product')->children()->text());
    }
}