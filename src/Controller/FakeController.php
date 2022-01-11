<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Ticket;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FakeController extends AbstractController
{



    public function insert(EntityManagerInterface $em) 
    {    
        $title = sprintf('Ticket n°%d', rand(1,1000));
        $ticket = new Ticket();
        $ticket->setTitle($title);
        $ticket->setDate(new DateTime());

        // Create Categoty
        $category = (new Category())
            ->setTitle('category '.rand())
            ->addTicket($ticket)
        ;
        $em->persist($category);

        // Create User
        $user = (new User())
            ->setUsername('username '.rand())
            ->addTicket($ticket)
        ;
        $em->persist($user);


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

    public function validate(
        EntityManagerInterface $em,
        ValidatorInterface $validator
    )
    {
        $title = sprintf('Ticket n°%d', rand(1,1000));
        $ticket = new Ticket();
        $ticket->setTitle($title);
        $ticket->setDate(new DateTime());

        // Create Categoty
        $category = (new Category())
            ->setTitle('category '.rand())
            ->addTicket($ticket)
        ;
        $em->persist($category);

        $violations = $validator->validate($ticket);

        dd($violations);
        if ($violations->count()) {
            dd($violations);
        }


        $em->persist($ticket);
        $em->flush();

        return new Response('is inserted !!!');
    }



}
