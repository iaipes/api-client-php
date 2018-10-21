<?php
namespace Iaipes\ApiClient\Tests\Unit;

use Iaipes\ApiClient\Tests\TestCase;
use Iaipes\ApiClient\Http\Client\Api\V1\CityClient;

class CityTest extends TestCase
{
    public function testIndex()
    {
        $client = new CityClient;
        $response = $client->index();
        $this->assertSuccessfulResponse($response);
    }

    public function testShow()
    {
        $client = new CityClient;
        $index_response = $client->index();
        if($this->isSuccessfulResponse($index_response) && isset($index_response->data[0])){
            $response = $client->show($index_response->data[0]->id);
            $this->assertSuccessfulResponse($response);
        }
    }
}
