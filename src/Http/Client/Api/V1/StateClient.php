<?php

namespace Iaipes\ApiClient\Http\Client\Api\V1;

use Iaipes\ApiClient\Http\Client\BaseClient;


class StateClient extends BaseClient
{
   public function index($data = [], $token = null)
    {
        return $this->request("GET", "api/v1/states", $data, $token);
    }

    public function show($uuid = "", $data = [], $token = null)
    {
        return $this->request("GET", "api/v1/states/".$uuid, $data, $token);
    }
}
