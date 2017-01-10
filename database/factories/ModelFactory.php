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
        'image' => config('users.avatar_default'),
        'gender' => $faker->numberBetween(0, 1),
        'level' => config('users.level.user'),
        'birthday' => Carbon::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'status' => config('users.status.active'),
    ];
});

$factory->define(App\Models\Survey::class, function (Faker\Generator $faker) {
    static $userIds;

    return [
        'user_id' => $faker->randomElement($userIds ?: $userIds = App\Models\User::pluck('id')->toArray()),
        'feature' => $faker->numberBetween(0,1),
        'title' => $faker->paragraph,
    ];
});

$factory->define(App\Models\Question::class, function (Faker\Generator $faker) {
    static $surveyIds;

    return [
        'content' => $faker->paragraph,
        'image' => config('settings.image_default'),
        'required' => $faker->numberBetween(0,1),
        'type' => $faker->numberBetween(1,4),
        'survey_id' => $faker->randomElement($surveyIds ?: $surveyIds = App\Models\Survey::pluck('id')->toArray()),
    ];
});

$factory->define(App\Models\Answer::class, function (Faker\Generator $faker) {
    static $questionIds;

    return [
        'content' => $faker->paragraph,
        'question_id' => $faker->randomElement($questionIds ?: $questionIds = App\Models\Question::pluck('id')->toArray()),
    ];
});

