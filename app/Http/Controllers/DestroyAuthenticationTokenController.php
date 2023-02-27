<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyAuthenticationTokenController extends Controller
{

    /**
     * Destroy an authenticated session.
     */
    public function __invoke(Request $request): JsonResponse
    {
        auth('sanctum')->user()->currentAccessToken()->delete();
        return $this->sendResponse(message: 'User successfully logged out');
    }
}
