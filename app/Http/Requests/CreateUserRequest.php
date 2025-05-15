<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'role_id' => ['required', 'exists:roles,id']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del usuario es requerido',
            'username.required' => 'El username es requerido',
            'username.unique' => 'El username ya esta en uso',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en uso',
            'password.required' => 'La contraseña es requerida',
            'role_id.required' => 'El rol del usuario es requerido',
            'role_id.exists' => 'El rol seleccionado no existe'
        ];
    }
}
