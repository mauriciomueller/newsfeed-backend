<?php

namespace Tests\Feature\NewsApiOrg;

use App\Services\NewsApiOrg\NewsApi;
use App\Services\NewsApiOrg\NewsApiEverything;
use App\Services\NewsApiOrg\NewsApiException;
use Tests\TestCase;

class NewsApiEverythingTest extends TestCase
{
    public NewsApi $newsApi;

    public function setUp(): void
    {
        parent::setUp();
        $this->newsApiEverything = new NewsApiEverything();
    }

    public function test_get_everything_throws_news_api_exception_if_invalid_language_used()
    {
        $this->expectException(NewsApiException::class);
        $this->expectExceptionMessage('This language code is not allowed.');
        $this->newsApiEverything->payload->setSources('mtv-news')->setLanguage('ek');
    }

    public function test_get_everything_throws_news_api_exception_if_invalid_sorting_used()
    {
        // TODO: refactor this tests
        $this->expectException(NewsApiException::class);
        $news = $this->newsApiEverything->getEverything($q=null, $sources=null, $domains=null, $exclude_domains=null, $from=null, $to=null, $language='en', $sort_by='quality');
    }

    public function test_get_everything_throws_news_api_exception_if_invalid_page_size_used()
    {
        // TODO: refactor this tests
        $this->expectException(NewsApiException::class);
        $news = $this->newsApiEverything->getEverything($q=null, $sources=null, $domains=null, $exclude_domains=null, $from=null, $to=null, $language='en', $sort_by=null, $page_size=1000);
    }
}
