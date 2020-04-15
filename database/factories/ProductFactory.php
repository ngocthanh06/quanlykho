<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'id_category' => rand(1,10),
        'id_supplier' => rand(1,10),
        'dvt' => 'vnd',
        'price_before' => $faker->randomNumber(6),
        'price_after' => $faker->randomNumber(6),
        'soluong' => 1
    ];
});
