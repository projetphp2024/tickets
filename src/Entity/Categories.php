<?php

namespace App\Entity;

use App\Entity\Trait\slugTrait;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    use slugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Tickets::class)]
    private Collection $technologie;

    #[ORM\OneToMany(mappedBy: 'technologie', targetEntity: Tickets::class)]
    private Collection $tickets;

    public function __construct()
    {
        $this->technologie = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Tickets>
     */
    public function getTechnologie(): Collection
    {
        return $this->technologie;
    }

    public function addTechnologie(Tickets $technologie): static
    {
        if (!$this->technologie->contains($technologie)) {
            $this->technologie->add($technologie);
            $technologie->setCategorie($this);
        }

        return $this;
    }

    public function removeTechnologie(Tickets $technologie): static
    {
        if ($this->technologie->removeElement($technologie)) {
            // set the owning side to null (unless already changed)
            if ($technologie->getCategorie() === $this) {
                $technologie->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tickets>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Tickets $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setTechnologie($this);
        }

        return $this;
    }

    public function removeTicket(Tickets $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getTechnologie() === $this) {
                $ticket->setTechnologie(null);
            }
        }

        return $this;
    }
}
