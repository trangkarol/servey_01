<?php

use Carbon\Carbon;
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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'password' => config('users.password_default'),
        'image' => $faker->imageUrl(124, 124, 'fashion', true, 'Faker', false),
        'gender' => $faker->numberBetween(0, 1),
        'level' => config('users.level.user'),
        'birthday' => Carbon::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'status' => config('users.status.active'),
        'background' => $faker->imageUrl(124, 124, 'fashion', true, 'Faker', false),
    ];
});

$factory->define(App\Models\Survey::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->paragraph,
        'description' => $faker->paragraph(),
        'feature' => $faker->numberBetween(0, 1),
        'token' => md5(uniqid(rand(), true)),
        'status' => $faker->numberBetween(0, 2),
        'end_time' => Carbon::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $min = 'now')),
        'start_time' => Carbon::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')),
        'token_manage' => md5(uniqid(rand(), true)),
    ];
});

$factory->define(App\Models\Section::class, function (Faker\Generator $faker) {
    static $order = 1;

    return [
        'title' => str_replace(' ', '', $faker->unique()->paragraph),
        'description' => $faker->paragraph(),
        'order' => $order ++,
        'update' => $faker->numberBetween(0, 1),
    ];
});

$factory->define(App\Models\Question::class, function (Faker\Generator $faker) {
    static $order = 1;   

    return [
        'title' => str_replace(' ', '', $faker->unique()->paragraph),
        'description' => $faker->paragraph(),
        'required' => $faker->numberBetween(0, 1),
        'update' => $faker->numberBetween(0, 1),
        'order' => $order ++,
    ];
});

$factory->define(App\Models\Answer::class, function (Faker\Generator $faker) {
    return [
        'content' => str_replace(' ', '', $faker->unique()->paragraph),
        'update' => $faker->numberBetween(0, 1),
    ];
});
