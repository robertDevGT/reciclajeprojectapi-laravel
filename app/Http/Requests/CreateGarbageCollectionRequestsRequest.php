<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGarbageCollectionRequestsRequest extends FormRequest
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
            'address_id' => ['required', 'exists:addresses,id'],
            'status_id' => ['required', 'exists:statuses,id'],
            'collector_id' => ['required', 'exists:collectors,id'],
            'fecha_recoleccion' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'La dirección es requerida',
            'address_id.exists' => 'La dirección no esta registrada',
            'status_id.required' => 'El estado es requerido',
            'collector_id.required' => 'El recolector es requerido',
            'collector_id.exists' => 'El recolector no esta registrado',
            'fecha_recoleccion.required' => 'La fecha de recolección es requerida',
        ];
    }
}
