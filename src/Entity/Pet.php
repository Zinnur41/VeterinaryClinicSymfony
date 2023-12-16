<?php

namespace App\Entity;

use App\Repository\PetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetRepository::class)]
class Pet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $breed = null;

    #[ORM\Column(length: 20)]
    private ?string $gender = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    private ?User $owner = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[ORM\OneToMany(mappedBy: 'pet', targetEntity: Examination::class)]
    private Collection $examinations;

    public function __construct()
    {
        $this->examinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(string $breed): static
    {
        $this->breed = $breed;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

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
            $examination->setPet($this);
        }

        return $this;
    }

    public function removeExamination(Examination $examination): static
    {
        if ($this->examinations->removeElement($examination)) {
            // set the owning side to null (unless already changed)
            if ($examination->getPet() === $this) {
                $examination->setPet(null);
            }
        }

        return $this;
    }
}
