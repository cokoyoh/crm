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
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super_admin'],
            ['name' => 'Company Admin', 'slug' => 'company_admin'],
            ['name' => 'Basic User', 'slug' => 'user'],
        ];

        collect($roles)
            ->each(function ($role) {
                \CRM\Models\Role::updateOrCreate($role);
            });
    }
}
