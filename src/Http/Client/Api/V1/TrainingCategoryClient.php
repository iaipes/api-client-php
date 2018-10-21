<?php

namespace Iaipes\ApiClient\Http\Client\Api\V1;

use Iaipes\ApiClient\Http\Client\BaseClient;


class TrainingCategoryClient extends BaseClient
{
   public function index($data = [], $token = null)
    {
        return $this->request("GET", "api/v1/training_categories", $data, $token);
    }

    public function show($uuid = "", $data = [], $token = null)
    {
        return $this->request("GET", "api/v1/training_categories/".$uuid, $data, $token);
    }
}
