<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StateRepository::class)]
#[ApiResource]
class State
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToOne(inversedBy: 'state', targetEntity: Country::class, cascade: ['persist', 'remove'])]
    private $country;

    #[ORM\OneToOne(mappedBy: 'state', targetEntity: City::class, cascade: ['persist', 'remove'])]
    private $city;

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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        // unset the owning side of the relation if necessary
        if ($city === null && $this->city !== null) {
            $this->city->setState(null);
        }

        // set the owning side of the relation if necessary
        if ($city !== null && $city->getState() !== $this) {
            $city->setState($this);
        }

        $this->city = $city;

        return $this;
    }
}
