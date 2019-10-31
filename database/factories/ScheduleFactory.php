<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CRM\Models\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'user_id' => create(\CRM\Models\User::class)->id,
        'lead_id' => create(\CRM\Models\Lead::class)->id,
        'date' => now()->format('Y-m-d'),
        'start_at' => now()->subHours(1)->format('H:i'),
        'end_at' => now()->addHours(2)->format('H:i')
    ];
});
