<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {    //    return reponse()->json(\Auth::user()->hasRole());

        // session(['success' => 'yes']);


        if(\Auth::user()->hasRole('admin')||\Auth::user()->hasRole('gerente')){
            return '/gerente/inicio';
        }
           // return '/gerente/inicio';
        
        
        
        if(\Auth::user()->hasRole('user'))
        return '/';
    
    }





}
