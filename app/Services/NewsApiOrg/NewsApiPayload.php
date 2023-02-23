<?php

namespace App\Services\NewsApiOrg;

class NewsApiPayload
{
    protected array $payload;

    public function __construct()
    {
        $this->setPageSize(9);
    }

    public function setSearch(string $search): NewsApiPayload
    {
        $this->payload['q'] = $search;
        return $this;
    }

    public function setSources(string $sources): NewsApiPayload
    {
        $this->payload['sources'] = $sources;
        return $this;
    }

    public function setPageSize(int $pageSize): NewsApiPayload
    {
        if ($pageSize >= 1 && $pageSize <= 100) {
            $this->payload['pageSize'] = $pageSize;
        }
        else{
            throw new NewsApiException("Invalid PageSize value provided");
        }

        return $this;
    }

    public function setPage(int $page): NewsApiPayload
    {
        $this->payload['page'] = $page;
        return $this;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
