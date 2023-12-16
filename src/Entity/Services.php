<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $service = null;

    #[ORM\Column]
    private ?int $cost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Examination::class)]
    private Collection $examinations;

    public function __construct()
    {
        $this->examinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Examination>
     */
    public function getExaminations(): Collection
    {
        return $this->examinations;
    }

    public function addExamination(Examination $examination): static
    {
        if (!$this->examinations->contains($examination)) {
            $this->examinations->add($examination);
            $examination->setService($this);
        }

        return $this;
    }

    public function removeExamination(Examination $examination): static
    {
        if ($this->examinations->removeElement($examination)) {
            // set the owning side to null (unless already changed)
            if ($examination->getService() === $this) {
                $examination->setService(null);
            }
        }

        return $this;
    }
}
