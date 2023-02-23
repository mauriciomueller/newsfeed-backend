<?php

namespace App\Services\NewsApiOrg;

class EverythingPayload
{
    protected array $payload = [
        'pageSize' => 9,
        'page' => 1
    ];

    public function setSearch(string $search): NewsApi
    {
        $this->payload['q'] = $search;
        return $this;
    }

    public function setSources(string $sources): NewsApiEverything
    {
        $this->payload['sources'] = $sources;
        return $this;
    }

    public function setPageSize(int $pageSize): NewsApi
    {
        if ($pageSize >= 1 && $pageSize <= 100) {
            $this->payload['pageSize'] = $pageSize;
        }
        else{
            throw new NewsApiException("Invalid PageSize Value Provided");
        }

        return $this;
    }

    public function setPage(int $page): NewsApi
    {
        $this->payload['page'] = $page;
        return $this;
    }
    public function getPayload(): array
    {
        return $this->payload;
    }
}
