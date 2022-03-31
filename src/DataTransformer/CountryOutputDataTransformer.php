<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\CountryOutput;
use App\Entity\Country;
use App\Entity\State;

class CountryOutputDataTransformer implements  DataTransformerInterface
{
   /**
    * @param CountryOutput $countryoutput
    */


    public function transform($countryoutput, string $to, array $context = [])
    {
       //dd($object, $to);
//        $output =  new CountryOutput();
//        $output->countryname = $countryoutput->getCountryname();
//        $output->state = $countryoutput->getState();
//        $output->country_code = $countryoutput->getCountryCode();
//         return $output;

         return CountryOutput::createFromEntity($countryoutput);


    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
       // dd('hello');
       //dd($data, $to);
        return $data instanceof  Country && $to === CountryOutput::class ;


    }


}