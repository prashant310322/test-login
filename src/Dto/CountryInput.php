<?php


namespace App\Dto;


use App\Entity\Country;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CountryInput
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
   public  $countryname;

    /**
     * @var Country
     *
     */
   public  $state;

    /**
     * @var string
     *  @Assert\NotBlank()
     *
     */
   public  $country_code;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     */
   public  $currency;

   public static  function createFromEntity(?Country $country): self
   {
       $dto = new CountryInput() ;

       IF (!$country)
       {
           return  $dto;
       }


       $dto->countryname = $country->getCountryname();
       $dto->country_code = $country->getCountryCode();
       $dto->currency  = $country->getCurrency();
       $dto->state =  $country->getState();

       return $dto;
   }

    public function createOrUpdateEntity(?Country $country): Country
    {
        if (!$country)
        {
            $country  = new Country();
        }

         $country->setCountryname( $this->countryname);
         $country->setCountryCode( $this->country_code);
         $country->setCurrency( $this->currency);
         $country->setState($this->state);


         return  $country;
    }
}