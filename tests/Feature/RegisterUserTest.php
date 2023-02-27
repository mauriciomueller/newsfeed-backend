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


    private string $route = 'user.register';

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);
    }

    public function test_register_user()
    {
        $this->post(route($this->route), $this->userData)->assertStatus(200)->assertJson([
            'success' => true,
            'message' => 'User successfully registered.',
            'result' => ''
        ]);
    }

    public function test_register_user_first_name_missing()
    {
        $this->userData['first_name'] = '';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'first_name' => ['The first name field is required.'],
        ]);
    }

    public function test_register_user_first_name_invalid()
    {
        $this->userData['first_name'] = 'a';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'first_name' => ['The first name must be at least 3 characters.'],
        ]);
    }

    public function test_register_user_last_name_missing()
    {
        $this->userData['last_name'] = '';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'last_name' => ['The last name field is required.'],
        ]);
    }

    public function test_register_user_last_name_invalid()
    {
        $this->userData['last_name'] = 'a';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'last_name' => ['The last name must be at least 3 characters.'],
        ]);
    }

    public function test_register_user_email_missing()
    {
        $this->userData['email'] = '';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'email' => ['The email field is required.'],
        ]);
    }

    public function test_register_user_email_invalid()
    {
        $this->userData['email'] = 'invalidemail';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'email' => ['The email must be a valid email address.'],
        ]);
    }

    public function test_register_user_password_missing()
    {
        $this->userData['password'] = '';
        $this->userData['password_confirmation'] = '';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'password' => ['The password field is required.'],
        ]);
    }

    public function test_register_user_password_less_then_7_characters()
    {
        $this->userData['password'] = '1234567';
        $this->userData['password_confirmation'] = '1234567';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'password' => ['The password must be at least 8 characters.'],
        ]);
    }

    public function test_register_user_password_confirmation_missing()
    {
        $this->userData['password'] = 'password';
        $this->userData['password_confirmation'] = '';

        $this->post(route($this->route), $this->userData)->assertStatus(422)->assertJson([
            'password' => ['The password confirmation does not match.'],
        ]);
    }

}
