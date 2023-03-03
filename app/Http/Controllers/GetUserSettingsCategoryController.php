<?php

namespace App\Http\Controllers;

use App\Models\SettingsCategory;
use App\Repositories\UserSettingsCategoryRepository;
use App\Services\GetUserSettingsCategoryService;
use Illuminate\Http\JsonResponse;

class GetUserSettingsCategoryController extends Controller
{

    public function __invoke(GetUserSettingsCategoryService $userSettingsCategoryService): JsonResponse
    {
        $user = auth('sanctum')->user();

        $result = $userSettingsCategoryService->byUserId($user->id);

        return $this->sendResponse($result, 'User settings categories retrieved successfully.');
    }
}
