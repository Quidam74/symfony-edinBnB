<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DayRepository")
 */
class Day
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"out"})
     * @MaxDepth(1)
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"out"})
     * @MaxDepth(1)
     */
    private $day;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

        return $this;
    }

}
