<?php

namespace App\Entity;

use App\Repository\SpeciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpeciesRepository::class)]
class Species
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scientific = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cycle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $watering = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sunlight = null;

    #[ORM\OneToMany(mappedBy: 'species', targetEntity: Plant::class)]
    private Collection $plants;

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getScientific(): ?string
    {
        return $this->scientific;
    }

    public function setScientific(?string $scientific): self
    {
        $this->scientific = $scientific;

        return $this;
    }

    public function getCycle(): ?string
    {
        return $this->cycle;
    }

    public function setCycle(?string $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }

    public function getWatering(): ?string
    {
        return $this->watering;
    }

    public function setWatering(?string $watering): self
    {
        $this->watering = $watering;

        return $this;
    }

    public function getSunlight(): ?string
    {
        return $this->sunlight;
    }

    public function setSunlight(?string $sunlight): self
    {
        $this->sunlight = $sunlight;

        return $this;
    }

    /**
     * @return Collection<int, Plant>
     */
    public function getPlants(): Collection
    {
        return $this->plants;
    }

    public function addPlant(Plant $plant): self
    {
        if (!$this->plants->contains($plant)) {
            $this->plants->add($plant);
            $plant->setSpecies($this);
        }

        return $this;
    }

    public function removePlant(Plant $plant): self
    {
        if ($this->plants->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getSpecies() === $this) {
                $plant->setSpecies(null);
            }
        }

        return $this;
    }
}
