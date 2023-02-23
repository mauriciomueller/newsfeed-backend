<?php
namespace App\Services\NewsApiOrg;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class NewsApi
{
    public ClientInterface $client;
    public NewsApiPayload $payload;

    public function __construct(
    )
    {
        $this->client = new Client([
            'base_uri' => env('NEWS_API_URL'),
            'timeout'  => 30,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('NEWS_API_TOKEN'),
            ],
        ]);

        $this->payload = new NewsApiPayload();
    }

    public abstract function isResponseStructureOk(ResponseInterface $response): bool;

    public function getDataFromApi(string $url): ResponseInterface
    {
        try{
            $response = $this->client->request('GET', $url, ['query'=>$this->payload->getPayload()]);

            if ($this->isResponseStructureOk($response)){
                return $response;
            } else{
                $response_body = json_encode($response->getBody());
                throw new NewsApiException($response_body->message);
            }
        }
        catch (GuzzleException $e)
        {
            throw new NewsApiException($e->getMessage());
        }
    }
}
