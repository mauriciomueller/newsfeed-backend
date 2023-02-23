<?php

namespace App\Http\Controllers;

use App\Services\News\SearchNewsService;
use App\Services\News\UserNewsService;
use App\Services\NewsApiOrg\NewsApiException;
use Illuminate\Http\JsonResponse;

class UserNewsController extends Controller
{
    /**
     * @param SearchNewsService $news
     */
    public function __construct(
        private SearchNewsService $news,
        private UserNewsService   $userNewsService
    ){
    }

    public function getUserNews(): JsonResponse
    {
        try {
            $user = auth('api')->user();

            $data = $this->userNewsService->getUserNews($user);

            return response()->json($data, 200);
        } catch (NewsApiException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
