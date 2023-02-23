<?php

namespace Database\Seeders;

use App\Models\SettingsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = SettingsCategory::insert([
            [
                'name' => 'Business',
                'code' => 'business',
            ],[
                'name' => 'Entertainment',
                'code' => 'entertainment',
            ],[
                'name' => 'General',
                'code' => 'general',
            ],[
                'name' => 'Health',
                'code' => 'health',
            ],[
                'name' => 'Science',
                'code' => 'science',
            ],[
                'name' => 'Sports',
                'code' => 'sports',
            ],[
                'name' => 'Technology',
                'code' => 'technology',
            ],
        ]);
    }
}
