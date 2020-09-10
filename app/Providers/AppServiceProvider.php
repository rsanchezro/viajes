<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive("priceformat", function ($expression)
        {
            return "<?php echo number_format(floatval($expression), 2, ',', '.').\" €\"; ?>";
        });

        Blade::directive("fecha_hispana", function ($expression)
        {
            return "<?php echo date('d-m-Y', strtotime($expression)); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
