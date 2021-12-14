<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Ticket  
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="title")
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $date;

    public function getId(): int {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle(string $title): Ticket {
        $this->title = $title;
        return $this;
    }

    public function getDate(): \DateTime {
        return $this->date;
    }

    public function setDate(\Datetime $date): Ticket {
        $this->date = $date;
        return $this;
    } 
    
}

