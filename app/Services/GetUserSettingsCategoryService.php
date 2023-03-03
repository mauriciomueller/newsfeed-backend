<?php

namespace App\Services;

use App\Models\SettingsCategory;
use App\Repositories\UserSettingsCategoryRepository;

class GetUserSettingsCategoryService
{
    public function __construct(
        private UserSettingsCategoryRepository $userSettingsCategoryRepository
    ) {
    }

    public function byUserId(int $userId): array
    {
        $result = [];
        $userSettingsCategories = $this->userSettingsCategoryRepository->getCategoriesByUserId($userId);

        SettingsCategory::all()->each(function (SettingsCategory $category) use (&$result, $userSettingsCategories) {
            $result[] = [
                'name' => $category->name,
                'value' => $category->code,
                'isSettingEnabled' => in_array($category->code, $userSettingsCategories->settings_categories_codes),
            ];
        });

        return $result;
    }
}
