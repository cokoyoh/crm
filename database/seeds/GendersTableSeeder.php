<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            ['name' => 'Male', 'slug' => 'male'],
            ['name' => 'Female', 'slug' => 'female'],
            ['name' => 'Other', 'slug' => 'other'],
        ];

        collect($genders)
            ->each(function ($gender) {
                \CRM\Models\Gender::updateOrCreate($gender);
            });
    }
}
