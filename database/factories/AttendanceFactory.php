<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
	return [
		'date' => $faker->dateTimeThisMonth,
		'is_sign_in' => $faker->boolean,
		'is_processed' => $faker->boolean
	];
});