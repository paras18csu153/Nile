<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'additionalInformation' => $faker->text,
        'category' => $faker->word,
        'price' => 700,
        'quantity' => 1000,
        'image' => 'uploads/3upAjpLqZjz9sL6imWYqORzqWhWCH0WnLMIWB1x0.png',
        'user_id' => 1
    ];
});