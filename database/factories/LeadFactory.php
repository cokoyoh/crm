<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CRM\Models\Lead;
use Faker\Generator as Faker;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'company_id' => null,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'country_code' => $faker->countryCode,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'lead_class_id' => null
    ];
});

$factory->state(Lead::class, 'raw', function (Faker $faker) {
   return [
       'name' => $faker->name()
   ];
});

$factory->define(CRM\Models\LeadClass::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug(3, false)
    ];
});

$factory->define(CRM\Models\LeadAssignee::class, function (Faker $faker) {
    return [
        'user_id' => create(\CRM\Models\User::class)->id,
        'lead_id' => create(Lead::class)->id
    ];
});

$factory->define(CRM\Models\Interaction::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(3, false),
        'lead_id' => create(Lead::class)->id
    ];
});

$factory->define(CRM\Models\LeadNote::class, function (Faker $faker) {
    return [
        'lead_id' => create(Lead::class)->id,
        'body' => $faker->sentence(8, false),
    ];
});
