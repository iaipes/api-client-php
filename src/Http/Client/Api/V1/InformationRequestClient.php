<?php

namespace Iaipes\ApiClient\Http\Client\Api\V1;

use Iaipes\ApiClient\Http\Client\BaseClient;


class InformationRequestClient extends BaseClient
{
   public function index($data = [], $token = null)
    {
        return $this->request("GET", "api/v1/information_requests", $data, $token);
    }

    public function show($uuid = "", $data = [], $token = null)
    {
        return $this->request("GET", "api/v1/information_requests/".$uuid, $data, $token);
    }
}
