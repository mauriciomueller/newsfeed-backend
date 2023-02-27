<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\SettingsCategorySeeder;
use Database\Seeders\SettingsSourceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_user_data_for_not_logged_in_users()
    {
        $this->get(route('user.get'))
            ->assertStatus(401);
    }

    public function test_get_user_data_for_logged_in_users(): void
    {
        $this->seed([
            UserSeeder::class,
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);

        $user = User::get()->first();
        $this->actingAs($user);

        #dd($this->get(route('user.get')));

        $this->get(route('user.get'))
            ->assertJsonStructure([
                'success',
                'result' => [
                    'user' => [
                        'id',
                        'first_name',
                        'last_name',
                        'email',
                        'email_verified_at',
                        'settings' => [
                            'categories' => [
                                '*' => [
                                    'id',
                                    'name',
                                    'code',
                                ],
                            ],
                            'sources' => [
                                '*' => [
                                    'id',
                                    'name',
                                    'language',
                                    'country',
                                ],
                            ]
                        ],
                    ],
                ],
                'message',
            ])
            ->assertStatus(200);
    }
}
