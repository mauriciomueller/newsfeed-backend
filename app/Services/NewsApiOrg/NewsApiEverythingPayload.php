<?php

namespace App\Services\NewsApiOrg;

class NewsApiEverythingPayload extends NewsApiPayload
{
    public function setSources(string $sources): NewsApiPayload
    {
        $this->payload['sources'] = $sources;
        return $this;
    }

    public function setFrom(string $from): NewsApiPayload
    {
        $this->payload['from'] = $from;
        return $this;
    }

    public function setTo(string $to): NewsApiPayload
    {
        $this->payload['to'] = $to;
        return $this;
    }

    public function setLanguage(string $language): NewsApiPayload
    {
        if (!Helpers::isLanguageValid($language)) {
            throw new NewsApiException("This language code is not allowed.");
        }

        $this->payload['language'] = $language;
        return $this;
    }
}
