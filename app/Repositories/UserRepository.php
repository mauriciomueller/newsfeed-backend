<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    public function registerUser(array $data, UserSettingsCategoryRepository $userSettingsCategoryRepository): void
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser($data);
            $this->userSettingsCategoryRepository->createUserSettingsCategory($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        };
    }

    public function createUser(array $userData): User
    {
        return User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);
    }
}
