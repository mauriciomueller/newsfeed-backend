<?php

namespace App\Http\Controllers;

use App\Services\GetLoggedUserService;
use Illuminate\Http\JsonResponse;

class GetLoggedUserDataController extends Controller
{
    public function __invoke(GetLoggedUserService $getUserService): JsonResponse
    {
        $userData = $getUserService->getUserData();

        return $this->sendResponse($userData);
    }
}
