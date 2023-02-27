<?php

namespace App\Http\Controllers;

use App\Services\GetUserService;
use Illuminate\Http\JsonResponse;

class GetUserController extends Controller
{
    public function __invoke(GetUserService $getUserService): JsonResponse
    {
        $userData = $getUserService->getUserData();

        return $this->sendResponse($userData);
    }
}
