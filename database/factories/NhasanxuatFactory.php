<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Nhasanxuat;
use Faker\Generator as Faker;

$factory->define(Nhasanxuat::class, function (Faker $faker) {
    return [
        'TenNSX' => $faker->name,
        'email' => $faker->email,
        'SDT' => $faker->phoneNumber ,
        'address' => $faker->address,
    ];
});
