<?php

use Faker\Generator as Faker;

$factory->define(App\Individual::class, function (Faker $faker) {
    $arSex = array('male', 'female');
    $sex = $arSex[array_rand($arSex)];

    return [
        'fio' => $faker->name($sex),
        'passport' => $faker->unique()->numerify('##########'),
        'sex' => function () use ($sex) {
            return (($sex == 'male') ? 'м' : 'ж');
        },
        'flat' => $faker->numberBetween(1, 80),
    ];
});
