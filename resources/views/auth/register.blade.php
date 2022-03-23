@extends('layouts.main')

@section('title')
    Registro
@endsection

@section('content')
    @include('layouts.header')
    @include('layouts.nav')
    <div class="container w-50">
        <h2 class="pt-5">Registro</h2>
        <form>
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="username" name="username">
                <div class="error" id="error-username"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="error" id="error-email"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth">
                <div class="error" id="error-dateOfBirth"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="error" id="error-password"></div>
            </div>
            <div class="mb-3">
                <a href="{{ route('main.login') }}">¿Ya tienes cuenta? Inicia sesión.</a>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-register">Registrar</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/register.js') }}"></script>
@endsection