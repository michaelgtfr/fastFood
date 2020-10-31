<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/10/2020
 * Time: 09:26
 */

namespace App\Controller;


use App\Entity\DetailCommand;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddInOrderBasketController
{
    private $id;

    private $quantity;

    private $products = [];

    /**
     * @Route("/addShoppingCart", name="app_add_shopping_cart_asynchronous")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @return Response|null
     */
    public function addInOrder(Request $request ,EntityManagerInterface $em, SessionInterface $session)
    {
        if($request->isXmlHttpRequest()) {
            $this->id = htmlspecialchars($request->get('id'));
            $this->quantity = htmlspecialchars($request->get('quantity'));

            $detailCommand = new DetailCommand();
            $product = $em->getRepository(Product::class)->find($this->id);
            $detailCommand->setProduct($product);
            $detailCommand->setQuantity($this->quantity);

            $this->products = $session->get('products');
            $this->products[$this->id] = $detailCommand;

            $session->set('products', $this->products);

            $data = [
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];

            $req =  json_encode($data);
            return new Response($req);
        }
        return null;
    }
}