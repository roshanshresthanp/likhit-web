<?php

namespace Database\Seeders;

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
        $this->call(AdminSeeder::class);
        $this->call(SettingSeeder::class);
        \App\Models\User::factory(50)->create();
        // \App\Models\Content::factory(50)->create();


    }
}
