<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSettingsCategory;

class UserSettingsCategoryRepository
{
    public function create(User $user): UserSettingsCategory
    {
        return $user->userSettingsCategories()->create([
            'user_id' => $user->id,
            'settings_categories_codes' => '[]',
        ]);
    }
}
