<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PromoCode;
use Faker\Generator as Faker;

$factory->define(PromoCode::class, function (Faker $faker) {
 // Define an array of possible prizes
    $prizes = ['5000 тенге', '10000 тенге', '15000 тенге', 'Футболку', 'Кружку', 'Ручку'];

    // Randomly select a prize from the array
    $prize = $faker->randomElement($prizes);

    return [
        'code' => $faker->unique()->regexify('[A-Z0-9]{8}'), // Generates a code with letters and numbers
        'is_winned' => $faker->boolean(10), // 10% chance of being a winner
        'prize' => $prize,
        // Add other attributes as needed
    ];
});