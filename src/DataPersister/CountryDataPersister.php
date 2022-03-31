<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;

class CountryDataPersister implements DataPersisterInterface
{
    private  $decoratedDataPersister;
    private EntityManagerInterface $entityManager;

    public function __construct(DataPersisterInterface $decoratedDataPersister, EntityManagerInterface $entityManager)
    {

        $this->decoratedDataPersister = $decoratedDataPersister;
        $this->entityManager = $entityManager;
    }

    public function supports($data): bool
    {
        return $data instanceof  Country;
    }

    public function persist($data)
    {
        $originalData = $this->entityManager->getUnitOfWork()->getOriginalEntityData($data);
        //dump($originalData);

        return $this->decoratedDataPersister->persist($data);
        //$this->decoratedDataPersister->persist($data);
        //$this->entityManager->persist($data);
        //$this->entityManager->flush();
    }

    public function remove($data)
    {
        return $this->decoratedDataPersister->remove($data);

    }

}