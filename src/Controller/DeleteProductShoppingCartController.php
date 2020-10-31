<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 23/10/2020
 * Time: 20:13
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProductShoppingCartController
{
    private $id;

    /**
     * @Route("/deleteProductShoppingCart", name="app_delete_asynchonous")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response|null
     */
    public function deleteProductShoppingCart(Request $request, SessionInterface $session)
    {
        if($request->isXmlHttpRequest()) {
            $this->id = htmlspecialchars($request->get('id'));

            $session->remove($this->id);

            return new Response();
        }
        return null;
    }
}