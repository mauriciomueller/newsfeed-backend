<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function createUser(array $userData): User
    {
        return $this->userRepository->create($userData);
    }

    public function createUserSettingsCategory(User $user): void
    {
        $user->userSettingsCategories()->create([
            'user_id' => $user->id,
            'settings_categories_codes' => json_encode([])
        ]);
    }
}
