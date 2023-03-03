<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\SettingsCategorySeeder;
use Database\Seeders\SettingsSourceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    private array $userData = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'registeruser@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    private array $failResponse = [
        'success' => false,
        'message' => 'Your request has a validation error.',
    ];

    private string $route = 'user.register';

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);
    }

    public function test_register_user(): void
    {
        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'User successfully registered.',
                'result' => ''
            ]);
    }

    public function test_register_user_first_name_missing(): void
    {
        $this->userData['first_name'] = '';
        $this->failResponse['errors'] = [
            'first_name' => ['The first name field is required.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_first_name_invalid(): void
    {
        $this->userData['first_name'] = 'a';
        $this->failResponse['errors'] = [
            'first_name' => ['The first name must be at least 3 characters.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_last_name_missing(): void
    {
        $this->userData['last_name'] = '';
        $this->failResponse['errors'] = [
            'last_name' => ['The last name field is required.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_last_name_invalid(): void
    {
        $this->userData['last_name'] = 'a';
        $this->failResponse['errors'] = [
            'last_name' => ['The last name must be at least 3 characters.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_email_missing(): void
    {
        $this->userData['email'] = '';
        $this->failResponse['errors'] = [
            'email' => ['The email field is required.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_email_invalid(): void
    {
        $this->userData['email'] = 'invalidemail';
        $this->failResponse['errors'] = [
            'email' => ['The email must be a valid email address.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_password_missing(): void
    {
        $this->userData['password'] = '';
        $this->userData['password_confirmation'] = '';
        $this->failResponse['errors'] = [
            'password' => ['The password field is required.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_password_less_then_7_characters(): void
    {
        $this->userData['password'] = '1234567';
        $this->userData['password_confirmation'] = '1234567';
        $this->failResponse['errors'] = [
            'password' => ['The password must be at least 8 characters.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

    public function test_register_user_password_confirmation_missing(): void
    {
        $this->userData['password'] = 'password';
        $this->userData['password_confirmation'] = '';
        $this->failResponse['errors'] = [
            'password' => ['The password confirmation does not match.'],
        ];

        $this->postJson(route($this->route), $this->userData)
            ->assertStatus(422)
            ->assertJson($this->failResponse);
    }

}
