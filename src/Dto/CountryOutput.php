<?php


namespace App\Dto;


use App\Entity\Country;

class CountryOutput
{
   public  $countryname;
   public  $state;
   public  $country_code;

    public  static  function  createFromEntity(Country $country): self
    {
        $output =  new CountryOutput();
        $output->countryname = $country->getCountryname();
        $output->state = $country->getState();
        $output->country_code = $country->getCountryCode();
        return $output;

    }
}