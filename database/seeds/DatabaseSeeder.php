<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [
        PermissionsTableSeeder::class,
        RolesTableSeeder::class,
        ContactStatusesTableSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        collect($this->seeders)
            ->each(function ($seeder) {
                $this->call($seeder);
            });
    }
}
