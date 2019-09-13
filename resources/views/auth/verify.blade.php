@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica Tu Direccion De Correo Electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, revise su correo electrónico para obtener un enlace de verificación') }}
                    {{ __('Si no recibiste el correo electrónico') }}, <a href="{{ route('verification.resend') }}">{{ __('Haga clic aquí para solicitar otro') }}</a>.
                    <input type='button' class="btn btn-primary" value='Continuar' onClick='history.go(-2);'>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
