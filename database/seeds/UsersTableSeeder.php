<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $role = app(\Spatie\Permission\PermissionRegistrar::class)
            ->getRoleClass()::findByName('admin', 'web');

        $admin = factory(\App\Models\User::class)->create([
            'email' => 'admin@sarente.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'name' => 'Administrator',
        ]);
        //$admin->assignRole($role);

        $admin = factory(\App\Models\User::class)->create([
            'email' => 'k1fathi33@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('pa$$w0rd'),
            'name' => 'Javad Fathi',
        ]);
        //$admin->assignRole('admin');
    }
}
