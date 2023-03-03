<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class UserPasswordResetLinkController extends Controller
{

    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            return $this->sendError('Error sending password reset link.', ['email' => [__($status)]], 422);
        }

        return $this->sendResponse(message: __($status));
    }
}
