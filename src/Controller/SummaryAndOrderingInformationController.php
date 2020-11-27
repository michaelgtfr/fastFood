<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 26/11/2020
 * Time: 00:51
 */

namespace App\Controller;


use App\Entity\Command;
use App\Form\CommandForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class SummaryAndOrderingInformationController
{

    /**
     * @Route("/additionalinformation", name="app_additional_information")
     * @param Request $request
     * @param Session $session
     * @param Environment $twig
     * @param UrlGeneratorInterface $generator
     * @param FormFactoryInterface $formFactory
     * @return RedirectResponse|Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function summaryAndOrderingInformationController(Request $request,Session $session, Environment $twig,
                                                            UrlGeneratorInterface $generator, FormFactoryInterface $formFactory)
    {
        //Recuperate the choice products in session
        $products = $session->get('products');

        //command form for recuperated the useful informations of client
        $command = new Command();
        $form = $formFactory->create(CommandForm::class, $command);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }

        if($products == null) {
            $session->getFlashBag()->add(
                'error',
                'Désolé, un problème technique à eu lieu, 
                veuillez re-éssayer de faire votre commande, si celle ne fonctionne pas, 
                veuillez signaler votre problème via le formulaire de contact'
            );
            $router = $generator->generate('app_command');
            return new RedirectResponse($router, 302);
        }

        // Prix total
        $totalPrice = 0;
        foreach ($products as $value) {
            $price = $value->getQuantity() * $value->getProduct()->getPrice();
            $totalPrice +=  $price;
        }

        $render = $twig->render('SummaryAndOrderingInformation.html.twig', [
            'form' => $form->createView(),
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
        return new Response($render);
    }
}