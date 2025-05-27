<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignCollectorRequest extends FormRequest
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
            'request_id' => 'required|exists:garbage_collection_requests,id',
            'collector_id' => 'required|exists:collectors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'request_id.required' => 'La solicitud es requerida',
            'request_id.exists' => 'La solicitud no existe',
            'collector_id.required' => 'El recolector es requerido',
            'collector_id.exists' => 'El recolector no existe',
        ];
    }
}
