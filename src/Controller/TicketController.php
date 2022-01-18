<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ticket")
 */
class TicketController extends AbstractController
{
    /**
     * @Route("/", name="ticket")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $tickets = $em->getRepository(Ticket::class)->findAll();
        
        return $this->render('ticket/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    /**
     * @Route("/new", name="ticket_new")
     */
    public function new(
        Request $request,
        EntityManagerInterface $em
    )
    {
        $form = $this->createForm(TicketType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $em->persist($ticket);
            $em->flush();
            return $this->redirectToRoute('ticket');

        }

        return $this->render(
            'ticket/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Ticket $ticket
     *
     * @Route("/show/{id}")
     */
    public function show(Ticket $ticket)
    {
        dd($ticket);
    }


    /**
     * @Route("/edit/{ticketId}", name="ticket_edit")
     */
    public function edit(
        $ticketId,
        Request $request,
        EntityManagerInterface $em
    )
    {
        $ticket = $em->getRepository(Ticket::class)
            ->find($ticketId);

        $form = $this->createForm(
            TicketType::class,
            $ticket
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $em->persist($ticket);
            $em->flush();
            return $this->redirectToRoute('ticket');

        }

        return $this->render(
            'ticket/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
