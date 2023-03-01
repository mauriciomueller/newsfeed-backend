<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\SettingsCategory;
use App\Models\SettingsSource;
use App\Models\User;
use App\Services\RegisterUserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangeUserPasswordController extends Controller
{
    public function __invoke(ChangePasswordRequest $request): JsonResponse
    {
        try {
            $request->validatePasswords($request->old_password, $request->new_password);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return $this->sendError('Error when validating passwords', $exception->errors(), 422);
        }

        $user = auth('sanctum')->user();
        $user->password = $request->new_password;
        $user->save();

        return $this->sendResponse(message: __('Your password was successfully updated.'));
    }
}
