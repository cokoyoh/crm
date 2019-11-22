<?php

use Illuminate\Database\Seeder;

class DealStageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dealStages = [
            ['name' => 'Pending', 'slug' => 'pending'],
            ['name' => 'Won', 'slug' => 'won'],
            ['name' => 'Lost', 'slug' => 'lost'],
            ['name' => 'Won & Verified', 'slug' => 'won-and-verified'],
        ];

        collect($dealStages)
            ->each(function ($dealStage) {
                CRM\Models\DealStage::updateOrCreate($dealStage);
            });
    }
}
