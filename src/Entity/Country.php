<?php

namespace App\Entity;

use App\Dto\CountryOutput;
use App\Dto\CountryInput;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource( output: CountryOutput::class, input: CountryInput::class) ]



class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
  
    private $countryname;

    #[ORM\Column(type: 'string', length: 30)]
   
    private $currency;

    #[ORM\Column(type: 'string', length: 255)]
  
    private $country_code ="INR";


    #[ORM\OneToOne(mappedBy: 'country', targetEntity: State::class, cascade: ['persist', 'remove'])]
   
    private $state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryname(): ?string
    {
        return $this->countryname;
    }

    public function setCountryname(string $countryname): self
    {
        $this->countryname = $countryname;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        // unset the owning side of the relation if necessary
        if ($state === null && $this->state !== null) {
            $this->state->setCountry(null);
        }

        // set the owning side of the relation if necessary
        if ($state !== null && $state->getCountry() !== $this) {
            $state->setCountry($this);
        }

        $this->state = $state;

        return $this;
    }
}
