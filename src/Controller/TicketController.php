<?php

namespace App\Controller;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
