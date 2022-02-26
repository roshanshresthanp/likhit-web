<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['id'=>1],
            ['name'=>'Super Admin',
            'email'=>'super@admin.com',
            'password'=>bcrypt('password')
        ]);
    }
}
