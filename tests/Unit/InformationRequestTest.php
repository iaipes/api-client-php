<?php
namespace Iaipes\ApiClient\Tests\Unit;

use Iaipes\ApiClient\Tests\TestCase;
use Iaipes\ApiClient\Http\Client\Api\V1\InformationRequestClient;

class InformationRequestTest extends TestCase
{
    public function testIndex()
    {
        $client = new InformationRequestClient;
        $response = $client->index();
        $this->assertSuccessfulResponse($response);
    }

    public function testShow()
    {
        $client = new InformationRequestClient;
        $index_response = $client->index();
        if($this->isSuccessfulResponse($index_response)){
            $response = $client->show($index_response->data[0]->uuid);
            $this->assertSuccessfulResponse($response);
        }
    }
}
