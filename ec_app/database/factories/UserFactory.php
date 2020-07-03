<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\ec_item::class, function (Faker $faker) {
    $items = array('寿司', 'ちらし・丼', '刺身' , 'サイドメニュー', '飲み物', 'デザート', 'その他');
    $key = array_rand($items);
    return [
        'name' => $faker->name,
        'price' => random_int(1,1000),
        'image' => str_random(20).'.png',
        'status' => random_int(0,1),
        'stock' => random_int(0,100),
        'detail' => str_random(10),
        'categories' => $items[$key],
    ];
});

$factory->define(App\ec_cart::class, function (Faker $faker) {
    return [
        'user_id' => random_int(0,100),
        'item_id' => random_int(0,100),
        'amount' => random_int(0,100),
    ];
});

$factory->define(App\ec_history::class, function (Faker $faker) {
    return [
        'user_id' => random_int(0,100),
        'total' => random_int(0,10000),
    ];
});

$factory->define(App\ec_detail::class, function (Faker $faker) {
    return [
        'history_id' => random_int(0,100),
        'item_id' => random_int(0,100),
        'amount' => random_int(0,100),
        'subtotal' => random_int(0,1000),
    ];
});