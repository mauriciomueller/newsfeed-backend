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

    public function getUser(Request $request): JsonResponse
    {
        $userInfo = [];

        $user = $request->user();
        $userInfo['user'] = $user->toArray();
        $userInfo['user']['settings']['categories'] = SettingsCategory::all()->toArray();
        $userInfo['user']['settings']['sources'] = SettingsSource::all()->toArray();

        return $this->sendResponse($userInfo);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateUserRequest $request): Response | JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = $this->userService->createUser($request->validated());
            $this->userService->createUserSettingsCategory($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError(__('Error while registering user'));
        }

        if(!isset($user)) {
            event(new Registered($user));
            Auth::login($user);
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
