<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 07/10/2020
 * Time: 16:33
 */

namespace App\Controller;


use App\Entity\DetailCommand;
use App\Entity\Product;
use App\Form\DetailForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class CommandController
{
    /**
     * @Route("/command", name="app_command")
     * @param Request $request
     * @param Environment $twig
     * @param EntityManagerInterface $em
     * @param FormFactoryInterface $formFactory
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function command(Request $request, Environment $twig, EntityManagerInterface $em,
                            FormFactoryInterface $formFactory, UrlGeneratorInterface $generator)
    {
        $command = new DetailCommand();
        $formCommand = $formFactory->create(DetailForm::class, $command);

        //recovery the product list
        $products = $em->getRepository(Product::class)
            ->findAll();

        //retrieving the order if it exists in session
        $panier = $request->getSession()->get('products') ?? null;

        $render = $twig->render('command.html.twig',[
            'formCommand' => $formCommand->createView(),
            'products' => $products,
            'panier' => $panier,
        ]);
        return new Response($render);
    }
}
