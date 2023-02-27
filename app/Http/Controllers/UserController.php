<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\SettingsCategory;
use App\Models\SettingsSource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
    }





    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateUserRequest $request): Response | JsonResponse
    {
        try {
            $this->userService->registerUser($request->validated());
        } catch (\Exception $e) {
            return $this->sendError(__('Error while registering user'), code: 500);
        }

        return $this->sendResponse($request->validated(), __('User created successfully.'));
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user = User::findOrFail(auth('sanctum')->user()->id);

        $user->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
        ]);

        return $this->sendResponse(message:__('Your profile was successfully updated.'));
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse | Response
    {
        try {
            $request->validatePasswords($request->old_password, $request->new_password);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return $this->sendError('Error when validating passwords', $exception->errors(), 422);
        }

        User::whereId(auth('sanctum')->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return $this->sendResponse(message: __('Your password was successfully updated.'));
    }
}
