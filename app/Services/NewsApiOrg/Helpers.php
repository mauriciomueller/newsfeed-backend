<?php

namespace App\Services\NewsApiOrg;

final class Helpers
{
    private static string $apiVersion = 'v2';

    private static array $data = [
        'countries' => [
            'ae', 'ar', 'at', 'au', 'be', 'bg', 'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg', 'fr', 'gb', 'gr',
            'hk', 'hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz','ph','pl', 'pt',
            'ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us','ve','za'
        ],
        'languages' => ['ar','en','cn','de','es','fr','he','it','nl','no','pt','ru','sv','ud'],
        'categories' => [
            'business',
            'entertainment',
            'general',
            'health',
            'science',
            'sports',
            'technology'
        ],
        'sort' => [
            'relevancy',
            'popularity',
            'publishedAt'
        ],
    ];

    final static public function topHeadlinesUrl(): string
    {
        return self::$apiVersion . "/top-headlines";
    }

    final static public function everythingUrl(): string
    {
        return self::$apiVersion . "/everything";
    }

    final static public function sourcesUrl(): string
    {
        return self::$apiVersion . "/sources";
    }

    final static public function isCountryValid(string $country): bool
    {
        if (in_array($country, self::$data['countries'])) {
            return true;
        }

        return false;
    }

    final static public function isLanguageValid(string $language): bool
    {
        if (in_array($language, self::$data['languages'])) {
            return true;
        }
        return false;
    }

    final static public function isCategoryValid(string $category): bool
    {
        if (in_array($category, self::$data['categories'])) {
            return true;
        }

        return false;
    }

    final static public function isSortByValid(string $sort_by): bool
    {
        if (in_array($sort_by, self::$data['sort'])) {
            return true;
        }
        return false;
    }

    final static public function getDataByKey(string $key): array|null
    {
        if(array_key_exists($key, self::$data)){
            return self::$data[$key];
        }
        return null;
    }
}
