<?php
namespace App\Services\NewsApiOrg;

use Psr\Http\Message\ResponseInterface;

class NewsApiTopHeadLines extends NewsApi
{

    public function __construct()
    {
        parent::__construct();
        $this->payload = new NewsApiTopHeadLinesPayload();
    }

    public function isResponseStructureOk(ResponseInterface $response): bool
    {
        if ($response->getStatusCode() != 200) return false;

        $data = json_decode($response->getBody(), true);

        if (!array_key_exists('status', $data)) return true;
        if ($data['status'] != 'ok') return false;

        return true;
    }

    /**
     * @throws NewsApiException
     */
    public function getTopHeadLines(): ResponseInterface
    {
        $url = Helpers::topHeadlinesUrl();
        return $this->getDataFromApi($url);
    }
}
