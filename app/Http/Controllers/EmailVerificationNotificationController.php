<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function __invoke(Request $request): JsonResponse|RedirectResponse
    {

        if ($request->user()->hasVerifiedEmail()) {
            return $this->sendResponse(['status' => 'verified-email'], __('Your email was already verified.'));
        }

        $request->user()->sendEmailVerificationNotification();

        return $this->sendResponse(['status' => 'verification-link-sent'], __('Verification link was sent to your email.'));
    }
}
