<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function create(array $userData): User
    {
        return User::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);
    }
}
