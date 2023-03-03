<?php

namespace App\Repositories;

use App\Models\UserSettingsCategory;

class UserSettingsCategoryRepository
{
    public function create(int $userId, string $categories = '[]'): UserSettingsCategory
    {
        return UserSettingsCategory::create([
            'user_id' => $userId,
            'settings_categories_codes' => $categories,
        ]);
    }

    public function getCategoriesByUserId(int $userId): UserSettingsCategory
    {
        return UserSettingsCategory::where('user_id', $userId)->first();
    }
}
