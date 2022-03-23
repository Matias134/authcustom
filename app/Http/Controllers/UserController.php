<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class UserController extends Controller
{

    public function getUser()
    {

        $user = User::where('id', session('loggedUser'))
            ->select('id', 'name', 'email', 'dateOfBirth')
            ->first();
        $age = $this->getAge($user->dateOfBirth);    
        $user->age = $age;
        return response()->json($user);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $year_of_birth = $request->dateOfBirth;
            $age = $this->getAge($year_of_birth);

            if ($this->validateAge($age)) {
                $user = new User();
                $user->name = $request->username;
                $user->email = $request->email;
                $user->dateOfBirth = $request->dateOfBirth;
                $user->password = Hash::make($request->password);
                $user->save();
                $request->session()->put('loggedUser', $user->id);
                return response()->json(['message' => 'Usuario creado'], 200);
            } else {
                return response()->json(['message' => 'El calculo de la edad es "' . $age . '" esta se encuentra fuera de los rangos permitidos(18 - 124)'], 400);
            }
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['message' => 'Ha ocurrido un error inesperado'], 500);
        }
    }



    public function login(Request $request)
    {
        try {

            $userInfo = User::where('email', $request->email)->first();
            if (!$userInfo) {
                return response()->json(['email' => 'Correo electronico no encontrado'], 400);
            } else {
                if (Hash::check($request->password, $userInfo->password)) {
                    $request->session()->put('loggedUser', $userInfo->id);
                    return response()->json(['message' => 'Iniciar sesion'], 200);
                } else {
                    return response()->json(['password' => 'Contraseña incorrecta'], 400);
                }
            }
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['message' => 'Ha ocurrido un error inesperado'], 500);
        }
    }

    public function logout()
    {
        try {
            if (session()->has('loggedUser')) {
                session()->pull('loggedUser');
                return response()->json(['message' => 'Cerrar sesion'], 200);
            }
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['message' => 'Ha ocurrido un error inesperado'], 500);
        }
    }

    public function getAge($year_of_birth)
    {
        $start = new DateTime($year_of_birth);
        $end = new DateTime();
        $end->setTimezone(new DateTimeZone('America/Santiago'));
        $age = $start->diff($end);
        return $age->y;
    }

    public function validateAge($age)
    {
        if ($age >= 18 && $age < 125) {
            return true;
        } else {
            return false;
        }
    }
}
