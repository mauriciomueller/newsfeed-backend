<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }


    public function registerUser(array $data): void
    {
        $this->userRepository->registerUser($data);
    }

}
