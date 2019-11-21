<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\CRM\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(8, false),
        'company_id' => create(\CRM\Models\Company::class)->id
    ];
});
