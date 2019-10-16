<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CRM\Models\Role;
use CRM\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'raw', [
    'name' => 'John Doe',
    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
]);

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug
    ];
});

$factory->define(\CRM\Models\Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug
    ];
});

$factory->define(\CRM\Models\RoleUser::class, function (Faker $faker) {
    return [
        'role_id' => null,
        'user_id' => null
    ];
});

$factory->define(\CRM\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'register_token' => null,
        'confirmed_at' => null
    ];
});
