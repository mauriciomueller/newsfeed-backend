<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\RegisterUserService;
use Illuminate\Http\JsonResponse;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request, RegisterUserService $registerUserService): JsonResponse
    {
        $requestValidated = $request->validated();

        try {
            $registerUserService->registerUser($requestValidated);
            return $this->sendResponse(message: __('User successfully registered.'));
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), code: 500);
        }
    }
}
