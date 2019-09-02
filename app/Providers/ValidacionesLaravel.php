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
        //validacion de cadenas que solo tenga letras y espacios
            {
                Validator::extend('con_espacios', function($attribute, $value)
            {
                return preg_match('/^[\pL\s]+$/u', $value);
            });
           
            //validacion de telefono consta de 10 digitos sin empezar con cero
                Validator::extend('tele_fono', function($attribute, $value)
                {
                    return preg_match('/[1-9][0-9]{9}/m', $value);
                });
            
                //validacion de codigopostal que consta de 5 digitos numericos
                Validator::extend('postal', function($attribute, $value)
                {
                    return preg_match('/[0-9]{5}/m', $value);
                });
                
                //validando ine que tenga 13 digitos numericos
                Validator::extend('ine', function($attribute, $value)
                {
                    return preg_match('/[0-9]{13}/m', $value);
                });
        }
        

       
    }


}
