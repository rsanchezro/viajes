<?php

/** Como los objetos de la clase Tour deben estár relacionados,
 * a través de una clave foránea, con objetos de la clase
 * Operator (el modelo Operator) es necesario empezar importando
 * dicha clase al principio, para tenerla disponible aquí. */

use App\Operator;
use Faker\Generator as Faker;

$factory->define(App\Tour::class, function (Faker $faker) {

    /** Obtenemos una colección de los elementos que haya de la clase
     * Operator, para poder usarlos en la clave foránea. */
    $operators = Operator::all();

    /** Obtenemos lo que será la fecha de inicio del viaje,
     * mediante faker. La duración en días la obtenemos como
     * un valor aleatorio entre 4 y 15, con PHP.
     * Finalmente, la fecha de final la obtenemos sumando los días
     * de duración a la fecha de inicio.
     * Estos datos son los que usamos luego para cumplimentar
     * los campos del registro. */
    $inicio = $faker->date('Y-m-d');
    $duracion = mt_rand(4, 15);
    $final = date('Y-m-d', strtotime('+ '.$duracion.' day', strtotime($inicio)));

    /** Observa que, a partir de la colección $operators,
     * obtenemos un operador al azar, con el método random().
     * Este método es de la colección. Lo tienen todas las
     * colecciones de registros. Del operador obtenido se
     * recupera la propiedad id para poder insertarla en el
     * campo operator_id que, como ya sabes, es la clave
     * foránea que indica quién es el operador de cada viaje. */
    return [
        'operator_id' => $operators->random()->id,
        'destino' => $faker->country,
        'inicio_fecha' => $inicio,
        'inicio_hora' => $faker->time('H:i:s'),
        'final_fecha' => $final,
        'final_hora' => $faker->time('H:i:s'),
        'precio' => $faker->randomFloat(2, 100.00, 5000.00),
        'duracion' => $duracion,
        'detalles' => $faker->paragraph(1)
    ];
});
