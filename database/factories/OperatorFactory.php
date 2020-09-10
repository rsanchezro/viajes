<?php

use Faker\Generator as Faker;

/** Se crea una matriz con los posibles rangos de los
 * operadores. Por criterio, hemos decidido que tales
 * rangos (podríamos considerarlos grados en la agencia)
 * irán de 0 a 10, expresados como cadenas de dos caracteres
 * con un cero a la izquierda, de relleno, en los grados
 * inferiores al 10.
 */
$rangos = [];
for ($i = 0; $i <= 10; $i ++) {
    $rangos[] = str_pad(strval($i), 2, '0', STR_PAD_LEFT);
}

/** Al ejecutaar la factory le decimos a la función que use
 * la matriz de rangos que hemos creado.
 * Una vez dentro de la función, para asignar el valor del
 * campo rango, se usa el método randomElement(). Este es
 * de Faker, y recibe una matriz, de la que extrae un elemento
 * al azar en cada ejecución.
 */
$factory->define(App\Operator::class, function (Faker $faker) use ($rangos) {
    return [
        'nombre' => $faker->name(),
        'ciudad' => $faker->city,
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'rango' => $faker->randomElement($rangos)
    ];
});
