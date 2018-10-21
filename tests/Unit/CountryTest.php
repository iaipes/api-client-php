<?php
namespace Iaipes\ApiClient\Tests\Unit;

use Iaipes\ApiClient\Tests\TestCase;
use Iaipes\ApiClient\Http\Client\Api\V1\CountryClient;

class CountryTest extends TestCase
{
    public function testIndex()
    {
        $client = new CountryClient;
        $response = $client->index();
        $this->assertSuccessfulResponse($response);
    }

    public function testShow()
    {
        $client = new CountryClient;
        $index_response = $client->index();
        if($this->isSuccessfulResponse($index_response) && isset($index_response->data[0])){
            $response = $client->show($index_response->data[0]->id);
            $this->assertSuccessfulResponse($response);
        }
    }
}
