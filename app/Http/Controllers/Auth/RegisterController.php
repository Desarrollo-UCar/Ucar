<?php

namespace App\Http\Controllers\Auth;
use App;
use DateTime;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'primer_apellido' => ['required', 'string', 'max:255'],
            'segundo_apellido' => ['required', 'string', 'max:255'],
            'nacionalidad' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'INE' => ['required', 'string', 'max:255'],
            'pasaporte' => ['required', 'string', 'max:255'],
            'calle' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:255'],
            'colonia' => ['required', 'string', 'max:255'],
            'ciudad' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'pais' => ['required', 'string', 'max:255'],
            'foto' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
       // return response()->json(['success'=>'esta es una prueba']);
        //crear cliente
// Creamos el objeto para Cliente
        $cliente = new App\Cliente;
        $cliente->nombre = $data['name'];
        $cliente->primer_apellido = $data['primer_apellido'];
        $cliente->segundo_apellido = $data['segundo_apellido'];
        $cliente->fecha_nacimiento = new DateTime('2000-01-01');
        $cliente->nacionalidad = $data['nacionalidad'];
        $cliente->credencial = $data['INE'];
        $cliente->pasaporte = $data['pasaporte'];
        $cliente->correo = $data['email'];
        $cliente->telefono = $data['telefono'];
        $cliente->calle = $data['calle'];
        $cliente->numero = 0;
        $cliente->colonia = $data['colonia'];
        $cliente->ciudad = $data['ciudad'];
        $cliente->estado = $data['estado'];
        $cliente->pais = $data['pais'];
        $cliente->foto = $data['foto'];

        $cliente->save();
        ///////
//crear usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
 
       $user->roles()->attach(Role::where('name', 'user')->first());
       return $user;

    }

    

    public function redirectTo()
    {    
        
        //return reponse()->json(\Auth::user()->hasRole());

        if(\Auth::user()->hasRole('admin'))
            return '/gerente/inicio';
        
        
        
        if(\Auth::user()->hasRole('user'))
        return '/';


        
    }

       
    
}

