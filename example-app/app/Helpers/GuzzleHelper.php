<?php

namespace App\Helpers;


use Exception;
use GuzzleHttp\Client;

class GuzzleHelper
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * GuzzleHelper constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Zapytanie GET
     *
     * @param string $url
     * @param array $headers
     * @return mixed
     * @throws Exception
     */
    public function get(string $url, array $headers)
    {
        return $this->send($url, 'GET', [], $headers);
    }

    /**
     * Formatowanie danych do wygodniejszego używania
     *
     * @param string $data
     * @return mixed
     */
    private function formatData(string $data)
    {
        return json_decode($data, false);
    }



    /**
     * Zapytanie POST
     *
     * @param string $url
     * @param array $body
     * @param array $headers
     * @param bool $format
     * @return mixed
     * @throws Exception
     */
    public function post(string $url, array $body, array $headers = [], $format = true)
    {
        return $this->send($url, 'POST', $body, $headers, $format);
    }

    public function put(string $url, array $body, array $headers = [], $format = true)
    {
        return $this->send($url, 'PUT', $body, $headers, $format);
    }

    public function delete(string $url, array $body = [], $headers)
    {
        return $this->send($url, 'DELETE', $body, $headers);
    }



        /**
        * @param string $url
        * @param string $method
        * @param array $body
        * @param array $headers
        * @return mixed
        * @throws Exception
        */
    private function send(string $url, string $method, array $body = [], array $headers = [], $format = true)
    {
        try{
            $response = $this->client->request($method, $url, [
                'json' => $body,
                'headers' => $headers
            ]);
            $data = $response->getBody()->getContents();

            if($format){
                return response()->json($this->formatData($data), $response->getStatusCode());
            }

            return response()->json($data, $response->getStatusCode());
        }catch(Exception $e){
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $data = json_decode((string) $response->getStatusCode());

                if($format){
                    return response()->json($this->formatData($data), $response->getStatusCode());
                }
                
                return response()->json($data, $response->getStatusCode());
            }
            throw new Exception($e->getResponse()->getBody()->getContents());
        }
    }
}