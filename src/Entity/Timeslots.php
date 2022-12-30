<?php

namespace App\Entity;

use App\Repository\TimeslotsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeslotsRepository::class)]
class Timeslots
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'timeslots')]
    private ?Days $day_id = null;

    #[ORM\Column(length: 10)]
    private ?string $start = null;

    // #[ORM\Column(type: Types::TIME_MUTABLE)]
    // private ?\DateTimeInterface $end = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayId(): ?Days
    {
        return $this->day_id;
    }

    public function setDayId(?Days $day_id): self
    {
        $this->day_id = $day_id;

        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    // public function getEnd(): ?\DateTimeInterface
    // {
    //     return $this->end;
    // }

    // public function setEnd(\DateTimeInterface $end): self
    // {
    //     $this->end = $end;

    //     return $this;
    // }
}
