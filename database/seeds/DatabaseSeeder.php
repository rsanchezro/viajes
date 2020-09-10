<?php

/** Importamos las clases de los modelos de las tres tablas que se
 * van a poblar.
 * Observa que no importamos el modelo de la tabla pivote.
 * Eso se debe a que, por ahora, no la vamos a usar nada más que como
 * tal tabla pivote, sin añadirle otros datos.
 */
use App\Operator;
use App\Tour;
use App\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory (Operator::class, 20)->create();

        /** Los customers que se crean se asignan a una colección
         * en memoria, para poder usarlos para crear las relaciones
         * con los tours. */
        $customers = factory (Customer::class, 300)->create();

        /** Cuando se crean los tours se usa el método each()
          * para indicar que con cada uno de ellos, vamos a hacer "algo".
         * Ese "algo" está definido en una función anónima que
         * se le pasa, como argumento, a dicho método each().
         *
         * Dentro de la función, a cada tour (variable $tour) se le
         * asigna el método customers(). Y aquí viene lo interesante.
         * Este método no es inherente a $tour. Está definido en el
         * modelo Tour.php Simplemente existe, para este objeto,
         * porque en el modelo lo hemos usado para
         * alojar el método belongsToMany(), indicando que debe
         * haber una relación m-n entre los objetos Tour y los objetos
         * Customer. Ahora ya tenemos ese método específico para
         * este objeto.
         * A continuación el método attach se encarga de elegir,
         * con ayuda de random(), una cantidad de customers aleatoria
 	     * entre 10 y 40.
         * El método pluck() extrae los id’s de esos customers y crea
         * los correspondientes registros en la tabla pivote.
         * Como en la migration de la tabla pivote se establecieron
         * las dos claves foráneas, el método customers, del modelo
         * Tour es capaz de crear esas relaciones.
         */
        factory (Tour::class, 100)
            ->create()
                ->each(function ($tour) use ($customers)
                    {
                        $tour->customers()
                            ->attach($customers
                                ->random(mt_rand(10, 40))
                                ->pluck('id')
                            );
                    }
                );
    }
}
