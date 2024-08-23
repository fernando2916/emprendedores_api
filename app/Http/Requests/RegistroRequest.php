<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)->letters()->symbols()->numbers()
            ]
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El nombre es obligatorio',
            'last_name' => 'El apellido es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'El correo ya esta registrado',
            'password' => 'La contraseña debe de contener al menos 8 caracteres, un símbolo y un numero y debe estar confirmada.',
            'password.confirmed' => 'Las contraseñas no son iguales'
        ];
    }
}
