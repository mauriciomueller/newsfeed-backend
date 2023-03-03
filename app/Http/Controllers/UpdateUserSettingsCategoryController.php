<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateUserSettingsCategoryController extends Controller
{
    public function __invoke(UpdateUserSettingsCategoryRequest $request): JsonResponse
    {

        $user = auth('sanctum')->user();
        $user->userSettingsCategories->settings_categories_codes = $request->settings_categories_codes;
        $user->userSettingsCategories->save();

        return $this->sendResponse(message: 'User settings categories updated successfully.');
    }
}
