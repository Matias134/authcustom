@extends('layouts.main')

@section('title')
    Login
@endsection

@section('content')
    @include('layouts.header')
    @include('layouts.nav')
    <div class="container w-50">
        <h2 class="pt-5">Iniciar sesión</h2>
        <form>
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="error" id="error-email"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password"> 
                <div class="error" id="error-password"></div>
            </div>
            <div class="mb-3">
                <a href="{{ route('main.register') }}">¿Aun no tienes cuenta? Registrate.</a>
            </div>
            <button type="submit" disabled class="btn btn-primary" id="btn-login">Iniciar sesión</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection