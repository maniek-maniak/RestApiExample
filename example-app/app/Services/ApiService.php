<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Helpers\GuzzleHelper;
use GuzzleHttp\Client;


class ApiService
{

    public function __construct(GuzzleHelper $guzzleHelper)
    {
        $this->guzzleHelper = $guzzleHelper;
    }

    public function getByStatusAvailable()
    {
        static $url = 'pet/findByStatus?status=available';

        return $this->guzzleHelper->get($this->composeUrl($url), []);

    }

    protected function composeUrl(string $url): string
    {
        return 'https://petstore.swagger.io/v2/'. $url;
    }

    protected function getHeaders(): array
    {
        $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];
        return $headers;
    }

    public function addNewPet($data)
    {
        static $url = 'pet';

        return $this->guzzleHelper->post($this->composeUrl($url), $data, $this->getHeaders());
    }

    public function getById($id)
    {
        $url = 'pet/'. $id;

        return $this->guzzleHelper->get($this->composeUrl($url), []);
    }

}