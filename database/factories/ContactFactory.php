<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CRM\Models\Contact;
use CRM\Models\ContactStatus;
use CRM\Models\ContactUser;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'lead_id' => null,
        'contact_status_id' => create(ContactStatus::class)->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->freeEmail,
        'phone' => $faker->phoneNumber,
        'kra_pin' => $faker->randomLetter . $faker->randomNumber(6, true) . $faker->randomLetter,
        'national_id' => $faker->randomNumber(8, true)
    ];
});

$factory->define(ContactStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->randomElement(['prospect', 'converted', 'lost'])
    ];
});

$factory->define(ContactUser::class, function (Faker $faker) {
    return [
        'user_id' => create(\CRM\Models\User::class)->id,
        'contact_id' => create(Contact::class)->id
    ];
});



