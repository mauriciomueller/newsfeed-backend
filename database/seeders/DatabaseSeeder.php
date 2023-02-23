<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SettingsCategory;
use App\Models\SettingsSource;
use App\Models\User;
use App\Models\UserSettingsCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SettingsCategorySeeder::class,
            SettingsSourceSeeder::class,
        ]);
    }
}
