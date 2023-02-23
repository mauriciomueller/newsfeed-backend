<?php

namespace Tests\Feature\NewsApiOrg;

use App\Services\NewsApiOrg\NewsApi;
use App\Services\NewsApiOrg\NewsApiException;
use App\Services\NewsApiOrg\NewsApiTopHeadLines;
use Tests\TestCase;

class NewsApiTopHeadLinesTest extends TestCase
{
    public NewsApi $newsApi;

    public function setUp(): void
    {
        parent::setUp();
        $this->newsApiTopHeadLines = new NewsApiTopHeadLines();
    }

    public function test_get_top_head_lines_throws_NewsApiException_if_Sources_used_with_country()
    {	$this->expectException(NewsApiException::class);
        $news = $this->newsApiTopHeadLines->setSources('bbc')->setCountry('ng')->getTopHeadLines();
    }

    public function test_get_top_head_lines_throws_NewsApiException_if_invalid_country_used()
    {	$this->expectException(NewsApiException::class);
        $news = $this->newsApiTopHeadLines->setCountry('kl')->getTopHeadLines();
    }

    public function test_get_top_head_lines_throws_news_api_exception_if_invalid_category_used()
    {	$this->expectException(NewsApiException::class);
        $news = $this->newsApiTopHeadLines->setCountry('aa')->setCategory('data')->getTopHeadLines();
    }

    public function test_get_top_head_lines_throws_news_api_exception_if_invalid_page_size_used()
    {	$this->expectException(NewsApiException::class);
        $news = $this->newsApiTopHeadLines->setCountry('ng')->setCategory('business')->setPageSize(1000)->getTopHeadLines();
    }

    public function test_get_top_headlines(){
        $newsApiTopHeadLines = new NewsApiTopHeadLines();
        $response = $newsApiTopHeadLines->getTopHeadLines();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }

}
