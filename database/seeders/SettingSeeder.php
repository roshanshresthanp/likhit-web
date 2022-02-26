<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::updateOrCreate(
            ['id'=>1],
            ['name'=>'Company name',
            'title'=>'Company title',
            'description'=>'Company description',
            'address'=>'Company address',
            'phone'=>'9856254798',
            'contact'=>'01540698',
            'map'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24864.309107685396!2d85.33295711510716!3d27.67061731296506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19f3eea02579%3A0x19e10c9012043046!2sKoteshwor%20Bus%20Stop!5e0!3m2!1sen!2snp!4v1643553358326!5m2!1sen!2snp',
            'email'=>'company@email.com',
        
        
        ]);
    }
}
