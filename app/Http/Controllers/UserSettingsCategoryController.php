<?php

namespace App\Http\Controllers;

use App\Models\SettingsCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserSettingsCategoryController extends Controller
{
    public function show(): JsonResponse
    {
        $userSettingsCategories = [];
        $user = auth('api')->user();
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

        return response()->json($userSettingsCategories, 200);
    }

    public function update(Request $request): Response
    {
        $user = auth('api')->user();
        $user->userSettingsCategories->settings_categories_codes = $request->settings_categories_codes;
        $user->userSettingsCategories->save();
        return response()->noContent();
    }
}
