<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(
        Request $request,
        FormFactoryInterface $formFactory
    ): Response
    {
        // A partir de l'usine, j'obtiens un constructeur de formulaire
        $builder = $formFactory->createBuilder();

        // Grâce à ce constructeur, il me permet de configuter
        // et de paramétrer mon formulaire
        $builder
            ->add('name', TextType::class)
            ->add('message', TextareaType::class)
        ;

        // De ce constructeur, je peux obtenir objet Form pour le traitement
        $form = $builder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            dd($form->getData());
        }


        // Obtention du from prêt pour la vue
        $formView = $form->createView();


        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $formView
        ]);
    }
}
