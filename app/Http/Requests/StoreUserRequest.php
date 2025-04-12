<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255'],
            'middle_name'      => ['nullable', 'string', 'max:255'], // Campo opcional
            'last_name'        => ['required', 'string', 'max:255'],
            'mother_last_name' => ['nullable', 'string', 'max:255'], // Campo opcional
            'phone'            => ['nullable', 'string', 'max:15'], // Suponiendo que es un teléfono con formato string
            'birthdate'        => ['nullable', 'date'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'string', 'min:8'], // Especifica longitud mínima para seguridad
            'profiles'         => ['nullable', 'array'], // Si es un array de roles
        ];
    }
    public function attributes(): array
    {
        return [
            'name'             => 'Nombre',
            'middle_name'      => 'Segundo nombre',
            'last_name'        => 'Apellido paterno',
            'mother_last_name' => 'Apellido materno',
            'phone'            => 'Número de teléfono',
            'birthdate'        => 'Fecha de nacimiento',
            'email'            => 'Correo electrónico',
            'password'         => 'Contraseña',
            'profiles'         => 'Perfiles',
        ];
    }
}
