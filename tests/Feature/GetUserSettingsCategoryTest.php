<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\SettingsCategorySeeder;
use Database\Seeders\SettingsSourceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserSettingsCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_categories_for_not_logged_in_users(): void
    {
        $this->get(route('user.categories.get'))
            ->assertStatus(401);
    }

    public function test_get_categories_for_logged_in_users(): void
    {
        $this->seed([
            UserSeeder::class,
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);

        $user = User::get()->first();
        $this->actingAs($user);

        $this->get(route('user.categories.get'))
            ->assertJson([
                'success' => true,
                'message' => 'User settings categories retrieved successfully.',
                'result' => [
                    [
                        'name' => 'Business',
                        'value' => 'business',
                        'isSettingEnabled' => true
                    ],[
                        'name' => 'Entertainment',
                        'value' => 'entertainment',
                        'isSettingEnabled' => false
                    ],[
                        'name' => 'General',
                        'value' => 'general',
                        'isSettingEnabled' => true
                    ],[
                        'name' => 'Health',
                        'value' => 'health',
                        'isSettingEnabled' => false
                    ],[
                        'name' => 'Science',
                        'value' => 'science',
                        'isSettingEnabled' => false
                    ],[
                        'name' => 'Sports',
                        'value' => 'sports',
                        'isSettingEnabled' => false
                    ],[
                        'name' => 'Technology',
                        'value' => 'technology',
                        'isSettingEnabled' => false
                    ],
                ],
            ])
            ->assertStatus(200);
    }
}
