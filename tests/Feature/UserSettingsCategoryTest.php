<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\SettingsCategorySeeder;
use Database\Seeders\SettingsSourceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSettingsCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_categories_for_not_logged_in_users(): void
    {
        $this->get(route('user.categories.show'))
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

        $this->get(route('user.categories.show'))
            ->assertJsonStructure([
                'success',
                'result' => [
                    '*' => [
                        'name',
                        'value',
                        'isSettingEnabled',
                    ],
                ],
                'message',
            ])
            ->assertStatus(200);
    }
}
