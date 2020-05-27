@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar dirección E-Mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de E-Mail.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, revise su E-Mail para obtener un enlace de verificación.') }}
                    {{ __('Si no recibiste el correo electrónico') }}, <a href="{{ route('verification.resend') }}">{{ __('haga clic aquí para solicitar otro') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
