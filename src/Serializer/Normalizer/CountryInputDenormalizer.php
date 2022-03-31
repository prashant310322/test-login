<?php


namespace App\Serializer\Normalizer;


use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Dto\CountryInput;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CountryInputDenormalizer  implements  DenormalizerInterface, CacheableSupportsMethodInterface
{

    private ObjectNormalizer $objectNormalizer;

    public  function  __construct(ObjectNormalizer $objectNormalizer){

        $this->objectNormalizer = $objectNormalizer;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        //dump($context);

       // $dto =  new CountryInput();
        //$dto->countryname = "Setting in denormalizer";

        //$context[AbstractItemNormalizer::OBJECT_TO_POPULATE] = $dto;

        $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] = $this->createDto($context);


        return $this->objectNormalizer->denormalize($data, $type, $format, $context);

    }


    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === CountryInput::class;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    private  function  createDto(array $context): CountryInput
    {
        $entity = $context[AbstractObjectNormalizer::OBJECT_TO_POPULATE]?? null;

//        $dto = new CountryInput() ;
//
//        IF (!entity)
//        {
//            return  $dto;
//        }

        if ($entity && !$entity instanceof CountryInput) {
            throw new \Exception(sprintf('Unexpected resource class "%s"', get_class($entity)));
        }

//        $dto->countryname = $entity->getCountryname();
//        $dto->country_code = $entity->getCountryCode();
//        $dto->currency  = $entity->getCurrency();
//        $dto->state =  $entity->getState();

       // return $dto;

          return  countryInput::createFromEntity($entity);


    }
}