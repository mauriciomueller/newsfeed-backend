<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;

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
