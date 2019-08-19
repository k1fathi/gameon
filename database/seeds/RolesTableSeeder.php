<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        \App\Models\Role::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::ROLE_ADMIN
        ]);

    }
}
