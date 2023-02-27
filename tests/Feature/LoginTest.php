<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserSettingsCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_token_creation(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'result' => [
                    'access_token',
                    'token_type',
                ],
                'message',
            ]);
    }

    public function test_user_token_creation_with_wrong_email(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('user.login'), [
            'email' => 'wrongemail',
            'password' => 'password',
        ])
            ->assertStatus(422)
            ->assertJson([
                'success' => false,
                'errors' => [
                    'email' => ['The email must be a valid email address.']
                ],
                'message' => 'Error when trying to login.',
            ]);
    }

    public function test_user_token_creation_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ])
            ->assertStatus(401)
            ->assertJson([
                'success' => false,
                'errors' => [
                    'email' => ['These credentials do not match our records.']
                ],
                'message' => 'Error when trying to login.',
            ]);
    }
}
