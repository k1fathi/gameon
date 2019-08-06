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
        \App\Models\Classroom::create([
            'category:'. App::getLocale()    => 'ilkokul',
            'number' => 1,
            'label:'. App::getLocale() => json_encode(['label1'=>'1C']),
        ]);
        \App\Models\Classroom::create([
            'category:'. App::getLocale()    => 'ortaokul',
            'number' => 6,
            'label:'. App::getLocale() => json_encode(['label1'=>'6B']),
        ]);
        \App\Models\Classroom::create([
            'category:'. App::getLocale()    => 'lise',
            'number' => 9,
            'label:'. App::getLocale() => json_encode(['label1'=>'9A']),
        ]);

        /*$classroom=\App\Models\Classroom::firstOrNew([
            'number' => 1,
        ]);
        $classroom->fill([
            'category:'. App::getLocale()    => 'ilkokul',
            'label:'. App::getLocale() => json_encode(['label1'=>'1C']),
        ]);
        $classroom->save();*/
    }
}
