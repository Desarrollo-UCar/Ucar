<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
class ValidacionesLaravel extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        ///
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        {
            Validator::extend('fecha_menor_a_la_actual', function($attribute, $horaRecogida){
                $hora_actual = strtotime(date('H\:i'));
                $hora_de_recogida = strtotime(date(" H\:i", strtotime($horaRecogida)));
                return $hora_de_recogida <= $hora_actual;
            });

        }
    }


}
