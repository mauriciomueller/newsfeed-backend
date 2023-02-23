<?php

namespace Tests\Feature\NewsApiOrg;

use App\Services\NewsApiOrg\NewsApi;
use App\Services\NewsApiOrg\NewsApiEverything;
use App\Services\NewsApiOrg\NewsApiException;
use Tests\TestCase;

class NewsApiSourceTest extends TestCase
{
    public NewsApi $newsApi;

    public function setUp(): void
    {
        parent::setUp();
        //TODO implemento sources endpoint test
        $this->newsApiEverything = new NewsApiEverything();
    }

    public function test_get_sources_throws_news_api_exception_if_invalid_category_used()
    {	$this->expectException(NewsApiException::class);
        $this->newsApiTopHeadLines->getSources($category='data', $language=null, $country=null);
    }

    public function test_get_sources_throws_news_api_exception_if_invalid_language_used()
    {	$this->expectException(NewsApiException::class);
        $this->newsApiTopHeadLines->getSources($category=null, $language='ek', $country=null);
    }

    public function test_get_sources_throws_news_api_exception_if_invalid_country_used()
    {	$this->expectException(NewsApiException::class);
        $this->newsApiTopHeadLines->getSources($category=null, $language=null, $country='kl');
    }

    public function test_get_sources(){
        //TODO Write Mocks API Call and response test
        $this->assertTrue(false);
    }

}
