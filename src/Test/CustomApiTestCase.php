<?php


namespace App\Test;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Doctrine\ORM\EntityManagerInterface;


class CustomApiTestCase extends  ApiTestCase
{

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::$container->get('doctrine')->getManager();

    }
}