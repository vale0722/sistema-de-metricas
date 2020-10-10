<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Invoice;
use Faker\Generator as Faker;

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

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(\App\Constants\Statuses::toArray()),
        'seller_id' => function () {
            return factory(\App\Entities\Seller::class)->create();
        },
        'created_at' =>  $faker->dateTimeThisMonth(),
    ];
});
