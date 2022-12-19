<?php

namespace App\Entity;

use App\Repository\HourlyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourlyRepository::class)]
class Hourly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $openeddays = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $closeddays = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $Timeslots = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpeneddays(): array
    {
        return $this->openeddays;
    }

    public function setOpeneddays(array $openeddays): self
    {
        $this->openeddays = $openeddays;

        return $this;
    }

    public function getCloseddays(): array
    {
        return $this->closeddays;
    }

    public function setCloseddays(array $closeddays): self
    {
        $this->closeddays = $closeddays;

        return $this;
    }

    public function getTimeslots(): array
    {
        return $this->Timeslots;
    }

    public function setTimeslots(array $Timeslots): self
    {
        $this->Timeslots = $Timeslots;

        return $this;
    }
}
