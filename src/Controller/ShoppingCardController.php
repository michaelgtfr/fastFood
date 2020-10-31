<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 31/10/2020
 * Time: 10:59
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCardController
{
    /**
     * @Route ("/shoppingCardValidate", name="app_validate_shopping_card")
     * @param Request $request
     */
    public function shoppingCard(Request $request)
    {
        dd($request->getSession()->all());
    }
}