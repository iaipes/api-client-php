<?php

namespace Iaipes\ApiClient\Http\Client;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use GuzzleHttp\Exception\RequestException;

class BaseClient
{
    public function __construct($options = [])
    {
        $token = function_exists('config') ? config("iaipes_apiclient.token", "") : getenv('IAIP_API_TOKEN');
        $base_uri = function_exists('config') ? config("iaipes_apiclient.url", "") : getenv('IAIP_API_URL');
        $timeout = function_exists('config') ? config("iaipes_apiclient.timeout", "") : getenv('IAIP_API_TIMEOUT');
        $timeout = empty($timeout) ? 60 : $timeout;

        $this->settings = array_merge([
            "token"  => $token,
            "client" => [
                // Base URI is used with relative requests
                'base_uri' => $base_uri,
                // You can set any number of default request options.
                'timeout'  => $timeout,
                'verify' => false
            ]
        ], $options);

        $this->client = new Client($this->settings["client"]);
    }

    public function httpOptions($data = [], $token = null, $json = true)
    {
        if (empty($token)) {
            $token = $this->settings["token"];
        }

        $http_options =[
            "headers" => [
                "Authorization" => "Bearer ".$token,
            ]
        ];

        if ($json == true) {
            $http_options["body"]= json_encode($data);
            $http_options["headers"]["Content-Type"]= "application/json";
        }

        return $http_options;
    }

    public function parseResponse($response)
    {
        $json = (string) $response->getBody();
        $data = (object) json_decode($json);
        if (!property_exists($data, "meta")) {
            $data->meta = [];
        }
        $data->meta = (object) $data->meta;
        $data->meta->status = $response->getStatusCode();
        return $data;
    }

    public function requestMultipart($method = "GET", $path = "", $data = [], $token = null, $options = [])
    {
        $method_param = [ "name"=> "_method", "contents"=> $method ];
        $data = $this->getMultipartData($data);
        $http_options = array_merge($this->httpOptions($data, $token, false), $options);
        $data[] = $method_param;
        $http_options["multipart"] = $data;
        try {
            $response = $this->client->request("POST", $path, $http_options);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if (class_exists('Illuminate\Support\Facades\Log', false)) {
                Log::error($e->getMessage());
            }

            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        return $this->parseResponse($response);
    }

    public function requestRaw($method = "GET", $path = "", $data = [], $token = null, $options = [])
    {
        $http_options = array_merge($this->httpOptions($data, $token), $options);
        $response = null;
        try {
            $response = $this->client->request($method, $path, $http_options);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if (class_exists('Illuminate\Support\Facades\Log', false)) {
                Log::error($e->getMessage());
            }

            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        return $response;
    }

    public function request($method = "GET", $path = "", $data = [], $token = null, $options = [])
    {
        $http_options = array_merge($this->httpOptions($data, $token), $options);
        $response = null;
        try {
            $response = $this->client->request($method, $path, $http_options);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if (class_exists('Illuminate\Support\Facades\Log', false)) {
                Log::error($e->getMessage());
            }

            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        return $this->parseResponse($response);
    }

    public function getMultipartData($params)
    {
        $params['data'] = (Array) $params['data'];
        $data = array_dot($params);

        $params = array_values(array_map(function ($value, $key) {
            $filename = null;
            if ($value instanceof UploadedFile) {
                $filename = $value->getClientOriginalName();
                $value = fopen($value->path(), 'r');
            }

            if (is_array($value)) {
                $value = null;
            }

            $result =  [
                'name' => $this->transformMultipartData($key),
                'contents' => $value
            ];

            if (!empty($filename)) {
                $result['filename'] = $filename;
            }

            return $result;
        }, $data, array_keys($data)));

        return $params;
    }

    public function transformMultipartData($key)
    {
        $root = current(explode('.', $key));

        return implode('', array_map(function ($key) use ($root) {
            return $key == $root ? $key : "[{$key}]";
        }, explode('.', $key)));
    }
}
