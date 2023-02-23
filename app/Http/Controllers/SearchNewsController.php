<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchNewsRequest;
use App\Services\News\NewsInterface;
use App\Services\News\SearchNewsService;

class SearchNewsController extends Controller
{

    public function searchNews(SearchNewsRequest $request, SearchNewsService $searchNewsService)
    {
        $validated = $request->validated();
        $data = $searchNewsService->searchNews($validated);

        return $data;
    }
}
