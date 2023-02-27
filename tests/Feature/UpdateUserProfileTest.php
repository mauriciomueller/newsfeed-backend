<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserSettingsCategory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UpdateUserProfileTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_user_can_update_profile(): void
    {
        $this->actingAs($this->user, 'sanctum');

        $this->putJson(route('user.update'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => $this->user->email,
        ])
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'result' => "",
                'message' => __('Your profile was successfully updated.')
            ]);

        $this->assertEquals('John', $this->user->fresh()->first_name);
        $this->assertEquals('Doe', $this->user->fresh()->last_name);
    }

    public function test_user_cant_update_profile_without_email(): void
    {
        $this->actingAs($this->user, 'sanctum');

        $this->putJson(route('user.update'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => '',
        ])
            ->assertStatus(422)
            ->assertJson([
                'success' => false,
                'errors' => [
                    'email' => [
                        __('The email field is required.'),
                    ],
                ],
                'message' => __('Error when trying to login.')
            ]);
    }

}
