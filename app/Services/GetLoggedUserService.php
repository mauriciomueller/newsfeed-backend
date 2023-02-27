<?php

namespace App\Services;

use App\Models\SettingsCategory;
use App\Models\SettingsSource;

class GetLoggedUserService
{

    public function getUserData(): array
    {
        $userInfo = [];

        $user = auth('sanctum')->user();

        if ($user) {
            $userInfo['user'] = $user->toArray();
            $userInfo['user']['settings']['categories'] = SettingsCategory::all()->toArray();
            $userInfo['user']['settings']['sources'] = SettingsSource::all()->toArray();
        }

        return $userInfo;
    }
}
