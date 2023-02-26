<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSettingsCategoryRepository
{
    public function createUserSettingsCategory(User $user): void
    {
        $user->userSettingsCategories()->create([
            'name' => 'Default',
            'is_default' => true,
        ]);
    }
}
