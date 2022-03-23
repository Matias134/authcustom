@extends('layouts.main')

@section('title')
    Bienvenido
@endsection

@section('content')
    @include('layouts.header')
    <div class="container-welcome">
        <h1 class="text-center">Bienvenido</h1>
        <div class="container-table">
            <table class="table table-striped table-bordered">
                <tr>
                    <th scope="row">Nombre de usuario:</th>
                    <td id="username"></td>
                </tr>
                <tr>
                    <th scope="row">Correo electronico:</th>
                    <td id="email"></td>
                </tr>
                <tr>
                    <th scope="row">Fecha de nacimiento:</th>
                    <td id="dateOfBirth"></td>
                </tr>
                <tr>
                    <th scope="row">Edad:</th>
                    <td id="age"></td>
                </tr>
            </table>
        </div>
        <button class="btn btn-danger" id="btn-logout">Cerrar sesión</button>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/welcome.js') }}"></script>
@endsection