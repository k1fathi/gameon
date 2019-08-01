<?php

use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'category:'. App::getLocale()    => 'ilkokul',
            'number' => 1,
            'label:'. App::getLocale() => ['label1'=>'label1'],
        ]);
        \App\Models\User::create([
            'category:'. App::getLocale()    => 'ortaokul',
            'number' => 6,
            'label:'. App::getLocale() => ['label1'=>'label1'],
        ]);
        \App\Models\User::create([
            'category:'. App::getLocale()    => 'lise',
            'number' => 9,
            'label:'. App::getLocale() => ['label1'=>'label1'],
        ]);

    }
}
