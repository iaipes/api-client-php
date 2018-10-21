<?php

namespace Iaipes\ApiClient\Http\Client\Api\V1;

use Iaipes\ApiClient\Http\Client\BaseClient;


class InstitutionClient extends BaseClient
{
   public function index($data = [], $token = null)
    {
        return $this->request("GET", "api/v1/institutions", $data, $token);
    }

    public function show($uuid = "", $data = [], $token = null)
    {
        return $this->request("GET", "api/v1/institutions/".$uuid, $data, $token);
    }
}
