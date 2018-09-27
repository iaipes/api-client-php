<?php
namespace Iaipes\ApiClient\Tests\Unit;

use Iaipes\ApiClient\Tests\TestCase;
use Iaipes\ApiClient\Http\Client\Api\V1\TrainingRequestClient;

class TrainingRequestTest extends TestCase
{
    public function testIndex()
    {
        $client = new TrainingRequestClient;
        $response = $client->index();
        $this->assertSuccessfulResponse($response);
    }

    public function testShow()
    {
        $client = new TrainingRequestClient;
        $index_response = $client->index();
        if($this->isSuccessfulResponse($index_response)){
            $response = $client->show($index_response->data[0]->uuid);
            $this->assertSuccessfulResponse($response);
        }
    }
}
