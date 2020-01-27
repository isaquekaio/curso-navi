<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Projeto;
use Faker\Generator as Faker;

$factory->define(Projeto::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'gerente_id' => factory(User::class),
    ];
});
