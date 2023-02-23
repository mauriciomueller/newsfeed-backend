<?php
namespace App\Services\NewsApiOrg;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Runner\Exception;
use Psr\Http\Message\ResponseInterface;

class NewsApiEverything extends NewsApi
{
    public function __construct()
    {
        parent::__construct();
        $this->payload = new NewsApiEverythingPayload();
    }

    public function isPayloadAllowed(): NewsApi
    {
        if (!(empty($this->payload['sources'])) && (!empty($this->payload['country']) || !empty($this->payload['category']))) {
            throw new NewsApiException("You Cannot Use Sources with Country or Category at the same time.");
        }

        return $this;
    }

    public function isResponseStructureOk(ResponseInterface $response): bool
    {
        if ($response->getStatusCode() != 200) return false;

        $data = json_decode($response->getBody(), true);

        if (!array_key_exists('status', $data)) return true;
        if ($data['status'] != 'ok') return false;

        return true;
    }

    public function filterPayloadEverything(): void
    {
        $allowedParams = Helpers::getDataByKey('countries');

        $this->payload = array_intersect_key($this->payload, array_flip($allowedParams));
    }

    public function getEverything(): ResponseInterface
    {
        $url = Helpers::everythingUrl();
        return $this->getDataFromApi($url);
    }

    public function getCountries(): array
    {
        return Helpers::getDataByKey('countries');
    }

    public function getLanguages(): array
    {
        return Helpers::getDataByKey('languages');
    }

    public function getCategories(): array
    {
        return Helpers::getDataByKey('categories');
    }

    public function getSortBy(): array
    {
        return Helpers::getDataByKey('sort');
    }
}
