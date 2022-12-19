<?php

namespace App\Entity;

use App\Repository\DaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DaysRepository::class)]
class Days
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column]
    private ?bool $open = null;

    #[ORM\OneToMany(mappedBy: 'day_id', targetEntity: Timeslots::class, orphanRemoval: true)]
    private Collection $timeslots;

    public function __construct()
    {
        $this->timeslots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function isOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

        return $this;
    }

    /**
     * @return Collection<int, Timeslots>
     */
    public function getTimeslots(): Collection
    {
        return $this->timeslots;
    }

    public function addTimeslot(Timeslots $timeslot): self
    {
        if (!$this->timeslots->contains($timeslot)) {
            $this->timeslots->add($timeslot);
            $timeslot->setDayId($this);
        }

        return $this;
    }

    public function removeTimeslot(Timeslots $timeslot): self
    {
        if ($this->timeslots->removeElement($timeslot)) {
            // set the owning side to null (unless already changed)
            if ($timeslot->getDayId() === $this) {
                $timeslot->setDayId(null);
            }
        }

        return $this;
    }
}
