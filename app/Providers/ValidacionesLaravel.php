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
        //
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
                Validator::extend('con_espacios', function($attribute, $value)
            {
                return preg_match('/^[\pL\s]+$/u', $value);
            });
           
            
                Validator::extend('tele_fono', function($attribute, $value)
                {
                    return preg_match('/[1-9][0-9]{9}/m', $value);
                });
            
        }
        

       
    }


}
