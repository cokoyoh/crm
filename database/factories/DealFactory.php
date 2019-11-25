<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\CRM\Models\DealStage::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3, false),
        'slug' => $faker->slug(3, false)
    ];
});

$factory->define(\CRM\Models\Client::class, function (Faker $faker) {
    return [
        'contact_id' => create(\CRM\Models\Contact::class)->id
    ];
});

$factory->define(\CRM\Models\Deal::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3, false),
        'deal_stage_id' => create(\CRM\Models\DealStage::class)->id,
        'product_id' => create(\CRM\Models\Product::class)->id,
        'user_id' => create(\CRM\Models\User::class)->id,
        'client_id' => create(\CRM\Models\Client::class)->id,
        'amount' => $faker->randomNumber(5, false)
    ];
});

$factory->define(\CRM\Models\VerifiedDeal::class, function (Faker $faker) {
    return [
        'deal_id' => create(\CRM\Models\Deal::class)->id,
        'user_id' => create(\CRM\Models\User::class)->id,
    ];
});

$factory->define(\CRM\Models\DealNote::class, function (Faker $faker) {
    return [
        'user_id' => create(\CRM\Models\User::class)->id,
        'deal_id' => create(\CRM\Models\Deal::class)->id,
        'body' => $faker->paragraph(3, false)
    ];
});
