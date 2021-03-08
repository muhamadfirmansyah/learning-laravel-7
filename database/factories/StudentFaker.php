<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        // 'nis' => $faker->numberBetween(200000, 299999),
        'nama' => $faker->name(),
        'id_kelas' => 2790,
        'password' => '1234567'
    ];
});
