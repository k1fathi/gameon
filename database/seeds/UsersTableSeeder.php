<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'email'    => 'javad.fathi@sarente.com',
            'password' => \Illuminate\Support\Facades\Hash::make('pa$$w0rd'),
            'name'     => 'Javad Fathi',
        ]);

        \App\User::create([
            'email'    => 'admin@sarente.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'name'     => 'Administrator',
        ]);

    }
}
