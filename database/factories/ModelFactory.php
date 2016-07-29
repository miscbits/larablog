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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/*
|--------------------------------------------------------------------------
| Article Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Article\Article::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'title' => 'I am Batman',
		'body' => 'I am Batman',
		'user_id' => '1',
		'created_at' => '2016-07-29 02:18:01',
		'updated_at' => '2016-07-29 02:18:01',
		'publish' => '1',
		'deleted' => '1',
		'published_at' => '2016-07-29',
		'subtitle' => 'laravel',


    ];
});
