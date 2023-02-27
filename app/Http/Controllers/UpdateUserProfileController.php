<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UpdateUserProfileController extends Controller
{

    public function __invoke(UpdateUserRequest $request): JsonResponse
    {
        $user = User::findOrFail(auth('sanctum')->user()->id);

        $user->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
        ]);

        return $this->sendResponse(message:__('Your profile was successfully updated.'));
    }
}
