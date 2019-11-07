<?php

use Illuminate\Database\Seeder;

class ContactStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Prospect', 'slug' => 'prospect'],
            ['name' => 'Converted', 'slug' => 'converted'],
            ['name' => 'Lost', 'slug' => 'lost'],
        ];

        foreach ($statuses as $status) {
            CRM\Models\ContactStatus::updateOrCreate($status);
        }
    }
}
