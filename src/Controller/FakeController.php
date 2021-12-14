<?php
namespace App\Controller;

use App\Entity\Ticket;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FakeController extends AbstractController
{
    public function insert(EntityManagerInterface $em) 
    {    
        $title = sprintf('Ticket n°%d', rand(1,1000));
        $ticket = new Ticket();
        $ticket->setTitle($title);
        $ticket->setDate(new DateTime());
        // Intégration de l'objet dans le UnitOfWork doctrine
        $em->persist($ticket);
        // Préparation de la commande + commit
        $em->flush();

        return new Response('Inserted');
    }

    public function detail(int $id, EntityManagerInterface $em)
    {
        $ticket = $em
            ->getRepository(Ticket::class)
            ->find($id)
        ;

        $ticket->setDate(new \DateTime());
        $ticket->setTitle($ticket->getTitle() . ' / ' . rand());

        $em->persist($ticket);
        $em->flush();

        var_export($ticket);
        return new Response(__METHOD__);
    }



}
