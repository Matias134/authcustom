<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:3|max:50',
            'email' => 'required|email:rfc,strict|unique:users',
            'dateOfBirth' => 'required|date',
            'password' => 'required|min:5|max:25'
        ];
    }

    public function attributes()
    {
        return [
            'username' => '"Nombre de usuario"',
            'email' => '"Correo electronico"',
            'dateOfBirth' => '"Fecha de nacimiento"',
            'password' => '"Contraseña"'
        ];
    }
}
