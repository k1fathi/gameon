<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'key'    => 'student_url',
            'value'    => 'http://206.189.24.233',
        ]);

        \App\Models\Setting::create([
            'key'    => 'teacher_url',
            'value'    => 'http://206.189.24.233',
        ]);

        \App\Models\Setting::create([
            'key'    => 'admin_url',
            'value'    => 'http://178.128.68.183',
        ]);
    }
}
