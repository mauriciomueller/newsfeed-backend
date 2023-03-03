<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAuthenticationTokenTest extends TestCase
{
    use RefreshDatabase;

    public string $route = 'user.login';

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->route), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertJsonStructure([
            'success',
            'result' => [
                'access_token',
                'token_type',
            ],
            'message',
        ])->assertStatus(201);

        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->postJson($this->route, [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
