<?php

namespace App\Behat\bootstrap;

use App\Entity\Product;
use Behat\Behat\Context\Context;
use Behat\Mink\Driver\GoutteDriver;
use Behat\MinkExtension\Context\MinkContext;
use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    protected $idProductFixture;

    /** @var KernelInterface */
    private  $kernel;

    /** @var \Behat\Mink\Session */
    private $session;

    /** @var RouterInterface */
    private $router;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param KernelInterface $kernel
     * @param \Behat\Mink\Session $session
     * @param RouterInterface $router
     */
    public function __construct(KernelInterface $kernel, \Behat\Mink\Session $session, RouterInterface $router )
    {
        $this->kernel = $kernel;
        $this->session = $session;
        $this->router = $router;
    }

    public function dataFixture()
    {
        $product = new Product();
        $product->setName('name test');
        $product->setDescription('description test');
        $product->setDesignation(1);
        $product->setAvailability(1);
        $product->setPrice('2');

        $em = $this->kernel->getContainer()->get('doctrine');
        $manager = $em->getManager();
        $manager->persist($product);
        $manager->flush();

        $productFixture = $em->getRepository(Product::class)->findOneBy(['name' => 'name test']);
        $this->idProductFixture = $productFixture->getId();
    }

    public function deleteDataFixture()
    {
        $em = $this->kernel->getContainer()->get('doctrine');
        $product = $em->getRepository(Product::class)->find($this->idProductFixture);

        $manager = $em->getManager();
        $manager->remove($product);
        $manager->flush();

    }

    /**
     * @BeforeSuite
     */
    public static function beforeSuite()
    {
        StaticDriver::setKeepStaticConnections(false);
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        $this->dataFixture();
        StaticDriver::beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        StaticDriver::rollBack();
        $this->deleteDataFixture();
        $this->session->restart();
    }

    /**
     * @AfterSuite
     */
    public static function afterSuite()
    {
        StaticDriver::setKeepStaticConnections(false);
    }

    /**
     * @Given I am on the :route page
     * @param $route
     */
    public function iAmOnThePage($route)
    {
        $this->visit($route);
    }

    /**
     * @When I click :button
     * @param $button
     */
    public function iClick($button)
    {
        $this->pressButton($button);
    }

    /**
     * @Then I should see the product in my product basket
     */
    public function iShouldSeeTheProductInMyProductBasket()
    {
        $this->getSession()->wait(5000);
        $this->assertResponseContains('shopping_class_'.$this->idProductFixture);
    }

    /**
     * @Given I must see written on the page :arg1
     * @param $arg1
     */
    public function iMustSeeWrittenOnThePage($arg1)
    {
        $this->assertResponseContains($arg1);
    }

    /**
     * @Given I see the chosen product in the product basket
     */
    public function iSeeTheChosenProductInTheProductBasket()
    {
        $this->iClick("Ajouter");
        $this->iShouldSeeTheProductInMyProductBasket();
    }

    /**
     * @When I click in the delete button of product
     */
    public function iClickInTheDeleteButtonOfProduct()
    {
        $this->pressButton("delete_shopping_". $this->idProductFixture);
    }

    /**
     * @Then I must no see the product in my product basket
     */
    public function iMustNoSeeTheProductInMyProductBasket()
    {
        $this->getSession()->wait(5000);
        $this->assertResponseNotContains('shopping_class_'.$this->idProductFixture);
    }

    /**
     * @Given I come back to the order page after leaving it
     */
    public function iComeBackToTheOrderPageAfterLeavingIt()
    {
        $this->iAmOnThePage('/command');
        $this->iClick("Ajouter");
        $this->iShouldSeeTheProductInMyProductBasket();
        $this->iAmOnThePage('/');
        $this->iAmOnThePage('/command');
    }

    /**
     * @Then I should see else the product in my product basket
     */
    public function iShouldSeeElseTheProductInMyProductBasket()
    {
        $this->assertResponseContains('shopping_class_'.$this->idProductFixture);
    }

    /**
     * @Given I want :number chosen product
     */
    public function iWantChosenProduct($number)
    {
        $this->selectOption('detail_form_quantity_'.$this->idProductFixture, $number);
    }

    /**
     * @Then I should see :number of the products in my product basket
     */
    public function iShouldSeeOfTheProductsInMyProductBasket($number)
    {
        $this->assertResponseContains($number);
    }

    /**
     * @Given After validating my shopping cart
     */
    public function afterValidatingMyShoppingCart()
    {
        $this->iAmOnThePage('/command');
        $this->iClick("Ajouter");
        $this->iShouldSeeTheProductInMyProductBasket();
        $this->iClick('Valider');
    }
}
