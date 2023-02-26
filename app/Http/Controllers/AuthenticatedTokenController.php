<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedTokenController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return $this->sendError('Error when trying to login.', $exception->errors(), 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        return $this->sendResponse($data, 'User ' . $user->full_name . ' successfully logged in');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
