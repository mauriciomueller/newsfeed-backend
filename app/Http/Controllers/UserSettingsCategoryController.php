<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingsCategoryUpdateRequest;
use App\Models\SettingsCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserSettingsCategoryController extends Controller
{


    public function show(): JsonResponse
    {
        $userSettingsCategories = [];
        $user = auth('sanctum')->user();
        $userSettingsCategoriesCodes = $user->userSettingsCategories;
        $settingsCategories = SettingsCategory::all()->toArray();

        if(count($settingsCategories) > 0) {
            $userSettingsCategories = array_map(function ($categorySetting) use ($userSettingsCategoriesCodes) {
                return [
                    'name' => $categorySetting['name'],
                    'value' => $categorySetting['code'],
                    'isSettingEnabled' => in_array($categorySetting['code'] , json_decode($userSettingsCategoriesCodes->settings_categories_codes)),
                ];
            }, $settingsCategories);
        }

        return $this->sendResponse($userSettingsCategories);

    }

    public function update(UserSettingsCategoryUpdateRequest $request): Response
    {


        $user = auth('sanctum')->user();
        $user->userSettingsCategories->settings_categories_codes = $request->settings_categories_codes;
        $user->userSettingsCategories->save();
        return response()->noContent();

    }
}
