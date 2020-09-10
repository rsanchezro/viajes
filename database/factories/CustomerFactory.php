<?php

use Faker\Generator as Faker;

$ccvs = [];
for ($i = 0; $i <= 999; $i ++) {
    $ccvs[] = str_pad(strval($i), 3, '0', STR_PAD_LEFT);
}

$factory->define(App\Customer::class, function (Faker $faker) use ($ccvs) {
    return [
        'nombre' => $faker->name(),
        'direccion' => $faker->streetAddress,
        'ciudad' => $faker->city,
        'tarjeta_tipo' => $faker->creditCardType,
        'tarjeta_num' => $faker->creditCardNumber,
        'tarjeta_exp' => $faker->creditCardExpirationDateString,
        'tarjeta_ccv' => $faker->randomElement($ccvs)
    ];
});
