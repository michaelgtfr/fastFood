<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 07/10/2020
 * Time: 16:33
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CommandController
{
    /**
     * @Route("/command", name="app_command")
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function command(Environment $twig)
    {
        $render = $twig->render('command.html.twig');
        return new Response($render);
    }
}