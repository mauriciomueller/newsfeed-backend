<?php

namespace App\Http\Controllers;

use App\Services\News\UserNewsService;
use App\Services\NewsApiOrg\NewsApiException;
use Illuminate\Http\JsonResponse;

class GetUserNewsController extends Controller
{
    public function __invoke(UserNewsService $userNewsService): JsonResponse
    {
        try {
            $user = auth('sanctum')->user();
            $data = $userNewsService->getUserNews($user);

            return $this->sendResponse($data);
        } catch (NewsApiException $e) {
            return $this->sendError($e->getMessage(), code:500);
        }
    }
}
