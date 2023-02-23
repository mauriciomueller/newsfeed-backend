<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSettingsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $userSettingsCategories = UserSettingsCategory::create([
            'user_id' => $user->id,
            'settings_categories_codes' => json_encode([
                'business',
                'general'
            ])
        ]);
    }
}
