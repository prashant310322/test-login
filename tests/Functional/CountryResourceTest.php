<?php


namespace App\Tests\Functional;

use App\Entity\Country;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CountryResourceTest extends ApiTestCase
{

    public function testCreateCountry()
    {

        $client = self::createClient();

        $client->request('POST', '/api/countries',
            ['headers' => ['Content-Type' => 'application/json'],
                'json' => ["countryname" => "Yazikstan",
                             "currency"=> "YKR1",
                            "state" => "/api/states/1",
                            "country_code"=> "YKR1"]
                                  ]);

//        $client->request('PUT', '/api/countries/1', [
//            'json' => []
//        ]);

        $this->assertResponseStatusCodeSame(401);
    }

}