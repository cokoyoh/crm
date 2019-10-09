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
            'Prospecting',
            'Converted',
            'Lost'
        ];

//        foreach ($statuses as $status) {
//            CRM\Models\ContactStatus::updateOrCreate($status);
//        }
    }
}
