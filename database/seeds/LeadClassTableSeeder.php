<?php

use Illuminate\Database\Seeder;

class LeadClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leadClasses = [
            ['name' => 'Not Followed Up', 'slug' => 'not_followed_up'],
            ['name' => 'Followed up', 'slug' => 'followed_up'],
            ['name' => 'Converted', 'slug' => 'converted'],
            ['name' => 'Lost', 'slug' => 'lost'],
            ['name' => 'Not Interested', 'slug' => 'not_interested'],
        ];

        collect($leadClasses)
            ->each(function ($leadClass) {
                \CRM\Models\LeadClass::updateOrCreate($leadClass);
            });
    }
}
