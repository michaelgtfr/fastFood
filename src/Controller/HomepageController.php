<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/10/2020
 * Time: 09:11
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomepageController
{
    /**
     * @Route("/", name="app_homepage")
     * @param Request $request
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param Session $session
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function homepage(Request $request, Environment $twig, FormFactoryInterface $formFactory, Session $session)
    {
        $contact = new Contact();
        $form = $formFactory->create(ContactForm::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $session->getFlashBag()->add(
                'success',
                'votre message a été envoyer'
            );
        }

        $render = $twig->render('homepage.html.twig', [
            'form' => $form->createView(),
        ]);
        return new Response($render);
    }
}
