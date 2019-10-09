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
        $permissions = [
            ['name' => 'Manage Company', 'slug' => 'manage_company'],
            ['name' => 'Manage Users', 'slug' => 'manage_users'],
        ];

        collect($permissions)
            ->each(function ($permission) {
                \CRM\Models\Permission::updateOrCreate($permission);
            });
    }
}
