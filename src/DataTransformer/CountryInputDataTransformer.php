<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Dto\CountryInput;
use App\Dto\CountryOutput;
use App\Entity\Country;
use App\Entity\State;

class CountryInputDataTransformer implements  DataTransformerInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {

        $this->validator = $validator;
    }

   /**
    * @param CountryInput $countryinput
    */

    public function transform($countryinput , string $to, array $context = [])
    {

        $this->validator->validate($countryinput);

        //dd('hello');
       //dd($countryinput, $to);
//        dump($countryinput);
//        if(isset($context[AbstractItemNormalizer::OBJECT_TO_POPULATE]))  {
//                //dd('it is querying first');
//                $countryinput = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
//
//                return $countryinput;
//        }
//        else {
//            $countryinput =  new CountryInput();
//           // dd('it is not query');
//        }

        $country = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] ?? null;

        return $countryinput->createOrUpdateEntity($country);


    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
       //dd('hello');
      // dd($data, $to, $context);
        //return $data instanceof  Country && $to === CountryOutput::class ;
        if ($data instanceof Country)
        {
            return false ;
        }

        return $to === Country::class && ($context['input']['class'] ?? null) === CountryInput::class;


    }


}