<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\user;
use Auth;
class UsuariosController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = 'gerente/inicio';

    public function username()
    {
        return 'email';
    }
    

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ////
        return view('gerente.usuarios.login.alta_usuarios');
    }

    public function create()
    {
        //
        //return view('prueba');
        return view('gerente.usuarios.login.alta_usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $request->validate([
            'nombres'=>'required',
            'primerApellido'=>'required',
            'segundoApellido'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        
        user::create($request->all());
        return redirect()->route('user.create');
    
        //return $request;
    }   
}

