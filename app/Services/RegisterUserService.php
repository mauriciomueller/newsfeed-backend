<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserSettingsCategoryRepository;
use Illuminate\Support\Facades\DB;

class RegisterUserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserSettingsCategoryRepository $userSettingsCategoryRepository,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function registerUser(array $data): void
    {
        DB::beginTransaction();
        $user = $this->userRepository->create($data);

        if($user === null) {
            DB::rollBack();
            throw new \Exception('Error while creating user.');
        }

        $userSettingsCategories = $this->userSettingsCategoryRepository->create($user->id);

        if($userSettingsCategories === null) {
            DB::rollBack();
            throw new \Exception('Error while creating user category settings.');
        }

        DB::commit();
    }
}
