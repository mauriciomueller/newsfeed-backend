<?php

namespace App\Http\Controllers;

use App\Services\News\UserNewsService;
use App\Services\NewsApiOrg\NewsApiException;
use Illuminate\Http\JsonResponse;

class UserNewsController extends Controller
{
    public function __construct(
        private UserNewsService $userNewsService
    ){
    }

    public function getUserNews(): JsonResponse
    {
        try {
            $user = auth('sanctum')->user();
            $data = $this->userNewsService->getUserNews($user);

            return $this->sendResponse($data);
        } catch (NewsApiException $e) {
            return $this->sendError($e->getMessage(), code:500);
        }
    }
}
