<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
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
            'calle' => ['required'],
            'codigo_postal' => ['required'],
            'colonia' => ['required'],
            'ciudad' => ['required'],
            'numero' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'calle.required' => 'La calle es requerida',
            'codigo_postal.required' => 'El código postal es requerido',
            'colonia.required' => 'La colonia es requerida',
            'ciudad.required' => 'La ciudad es requerida',
            'numero.required' => 'El número es requerido',
        ];
    }
}
