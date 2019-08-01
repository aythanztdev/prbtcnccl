<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    public function get(string $url, array $params = [])
    {
        if (count($params) > 0)
            $response = $this->httpClient->request('GET', $url, [
                'query' => $params
            ]);
        else
            $response = $this->httpClient->request('GET', $url);

        if ($response->getStatusCode() !== 200)
            throw new BadRequestHttpException('The service for getting the currency exchange is unavailable at this moment');

        return $response->getContent();
    }
}