<?php

namespace App\Services\News;

use App\Models\SettingsCategory;
use App\Models\User;
use App\Services\News\DateRanges\DateRangeInterface;
use App\Services\News\DateRanges\Last24Hour;
use App\Services\News\DateRanges\LastHour;
use App\Services\News\DateRanges\LastWeek;
use App\Services\News\DateRanges\LastYear;
use App\Services\NewsApiOrg\Exception;
use App\Services\NewsApiOrg\NewsApi;
use App\Services\NewsApiOrg\NewsApiEverything;
use App\Services\NewsApiOrg\NewsApiException;
use App\Services\NewsApiOrg\NewsApiInterface;
use App\Services\NewsApiOrg\NewsApiPayload;
use App\Services\NewsApiOrg\NewsApiTopHeadLines;

class SearchNewsService
{
    private DateRangeInterface $dateRange;

    public function __construct(
        private NewsApiTopHeadLines $newsApiTopHeadLines,
        private NewsApiEverything $newsApiEverything,
    )
    {
    }

    public function searchNews(array $params): array
    {
        extract($params);

        if(!empty($q)) {
            $this->newsApiTopHeadLines->payload->setSearch($q);
            $this->newsApiEverything->payload->setSearch($q);
        }

        if(!empty($category)) {
            $this->newsApiTopHeadLines->payload->setCategory($category);
            return json_decode($this->newsApiTopHeadLines->getTopHeadLines()->getBody(), true)['articles'];
        }

        if(!empty($sources)) {
            $this->newsApiEverything->payload->setSources($sources);
        }

        if(!empty($date)) {
            $this->setFrom($date);
        }

        return json_decode($this->newsApiEverything->getEverything()->getBody(), true)['articles'];
    }

    public function setFrom(string $date): SearchNewsService
    {
        switch ($date) {
            case 'last_hour':
                $this->dateRange = new LastHour();
                break;
            case 'last_24_hours':
                $this->dateRange = new Last24Hour();
                break;
            case 'last_week':
                $this->dateRange = new LastWeek();
                break;
            case 'last_year':
                $this->dateRange = new LastYear();
                break;
            default:
                return $this;
        }

        $this->newsApiEverything->payload->setFrom($this->dateRange->getDate());

        return $this;
    }
}
