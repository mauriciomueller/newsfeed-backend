<?php

namespace App\Services\NewsApiOrg;

class NewsApiTopHeadLinesPayload extends NewsApiPayload
{
    public function __construct()
    {
        parent::__construct();
        $this->setCountry('us');
    }

    public function setSources(string $sources): NewsApiPayload
    {
        unset($this->payload['category']);
        unset($this->payload['country']);
        $this->payload['sources'] = $sources;

        return $this;
    }

    /**
     * @throws NewsApiException
     */
    public function setCountry(string $country): NewsApiPayload
    {
        if (!Helpers::isCountryValid($country)) {
            throw new NewsApiException("This country code is not allowed.");
        }

        $this->payload['country'] = $country;

        return $this;
    }

    /**
     * @throws NewsApiException
     */
    public function setCategory(string $category): NewsApiPayload
    {
        unset($this->payload['sources']);

        if (!Helpers::isCategoryValid($category)) {
            throw new NewsApiException("Invalid Category Identifier Provided");
        }

        $this->payload['category'] = $category;

        return $this;
    }
}
