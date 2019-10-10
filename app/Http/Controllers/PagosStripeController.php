<?php

namespace App\Http\Controllers;


//\Stripe\Stripe::setApiKey("sk_test_g438z43nqZjPgMKl3HsgoFWr00AMhhStVt");
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Http\Controllers\Controller;


class PagosStripeController extends Controller{
    public function crear_pago_stripe(Request $request){
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
        $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
        $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1990,
                'currency' => 'mxn'
            ));
        return 'Cargo exitoso!';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
     }

    

       
}
