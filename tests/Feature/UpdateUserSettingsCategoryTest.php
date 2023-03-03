<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\SettingsCategorySeeder;
use Database\Seeders\SettingsSourceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserSettingsCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_categories_for_not_logged_in_users()
    {
        $this->get(route('user.categories.update'))
            ->assertStatus(401);
    }

    public function test_update_categories_for_logged_in_users_with_empty_array()
    {
        $this->seed([
            UserSeeder::class,
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);

        $user = User::get()->first();
        $this->actingAs($user);

        $this->put(route('user.categories.update'), [
            'settings_categories_codes' => [],
        ])
            ->assertJson([
                'success' => true,
                'message' => 'User settings categories updated successfully.',
                'result' => '',
            ])->assertStatus(200);
    }

    public function test_update_categories_for_logged_in_users()
    {
        $this->seed([
            UserSeeder::class,
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);

        $user = User::get()->first();
        $this->actingAs($user);

        $this->put(route('user.categories.update'), [
            'settings_categories_codes' => [
                'business',
                'general',
                'health',
            ],
        ])
            ->assertJson([
                'success' => true,
                'message' => 'User settings categories updated successfully.',
                'result' => '',
            ])->assertStatus(200);
    }

    public function test_update_categories_for_logged_in_users_with_string()
    {
        $this->seed([
            UserSeeder::class,
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);

        $user = User::get()->first();
        $this->actingAs($user);

        $this->put(route('user.categories.update'), [
            'settings_categories_codes' => 'business,general,health',
        ])
            ->assertJson([
                'success' => false,
                'errors' => [
                    'settings_categories_codes' => [
                        'The settings categories codes must be an array.',
                    ],
                ],
                'message' => 'Your request have a validation error.',
            ])->assertStatus(422);
    }
}
