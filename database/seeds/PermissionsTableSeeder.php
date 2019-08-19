<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'project-create'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'project-update'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'project-delete'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'project-done'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'rosette-attach'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'rosette-detach'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'step-add'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'step-done'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'step-remove'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'claim-accept'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'feed-add'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'rosette-hold'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'rosette-create'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'rosette-delete'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'rosette_update'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'club-create'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'club-update'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'club-delete'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'question_create'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'question_delete'
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => 'question_update'
        ]);
    }
}
