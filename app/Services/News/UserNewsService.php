<?php
namespace App\Services\News;

use App\Models\SettingsCategory;
use App\Models\User;
use App\Services\NewsApiOrg\Exception;
use App\Services\NewsApiOrg\NewsApiException;
use App\Services\NewsApiOrg\NewsApiInterface;
use App\Services\NewsApiOrg\NewsApiTopHeadLines;
use Psr\Http\Message\ResponseInterface;

class UserNewsService
{
    public function __construct(
        private NewsApiTopHeadLines $newsApiTopHeadLines,
    )
    {
    }

    public static function mergeArticlesWithSameUrl(array $articles): array
    {
        $i = 0;
        $key = 'url';
        $keyArray = [];
        $mergedArray = [];
        $categoryStack = [];

        foreach($articles as $article) {
            if (!in_array($article[$key], $keyArray)) {
                $keyArray[$i] = $article[$key];
                $mergedArray[$i] = $article;
                $categoryStack[$article[$key]] = $i;
            } else {
                $mergedArray[$categoryStack[$article[$key]]]['categories'][] = $article['categories'][0];
            }
            $i++;
        }

        return $mergedArray;
    }

    public function getTopHeadLines(): ResponseInterface
    {
        return $this->newsApiTopHeadLines->getTopHeadLines();
    }

    /**
     * @throws NewsApiException
     */
    public function getTopHeadLinesArticles(): array
    {
        $response = $this->getTopHeadLines();

        return json_decode($response->getBody(), true)['articles'];
    }

    private function createYourNewsArray(array $newsByCategory): array
    {
        $yourNewsArray = [];
        $i = 0;

        foreach ($newsByCategory as $key => $newsCategory) {
            foreach ($newsCategory['articles'] as $news) {
                $yourNewsArray[$i] = $news;
                $yourNewsArray[$i]['categories'][] = $newsCategory['categoryTitle'];
                $i++;
            }
        }

        $yourNewsArray = self::mergeArticlesWithSameUrl($yourNewsArray);
        shuffle($yourNewsArray);
        return array_slice($yourNewsArray, 0, 9);
    }

    private function getNewsByCategories(array $categories): array
    {
        $newsByCategory = [];

        foreach ($categories as $category) {
            $this->newsApiTopHeadLines->payload->setCategory($category);
            $articles = $this->getTopHeadLinesArticles();
            $newsByCategory[$category]['articles'] = $articles;
            $newsByCategory[$category]['categoryTitle'] = SettingsCategory::where('code', $category)->pluck('name')->first();
        }

        return $newsByCategory;
    }

    /**
     * @throws NewsApiException
     */
    public function getUserNews(User $user): array
    {
        $categories = json_decode($user->userSettingsCategories->settings_categories_codes);
        $response = [];

        if (count($categories) === 0) {
            $response['yourNews'] = $this->getTopHeadLinesArticles();
            return $response;
        }

        $response['byCategories'] = $this->getNewsByCategories($categories);
        $response['yourNews'] = $this->createYourNewsArray($response['byCategories']);

        return $response;
    }
}
