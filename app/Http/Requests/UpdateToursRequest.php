<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateToursRequest extends FormRequest
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
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'title' => 'sometimes|string|max:255|min:5',
                'description' => 'sometimes|string|min:50',
                'price' => 'sometimes|numeric|min:0|',
                'location' => 'sometimes|string|max:255'
            ];
        } else {
            return [
                'title' => ['sometimes', 'string'],
                'description' => ['sometimes', 'string'],
                'price' => ['sometimes', 'numeric'],
                'location' => ['sometimes', 'string']

            ];

        }
    }

    public function messages(): array
    {
        return [
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'title.min' => 'El título debe tener al menos 5 caracteres.',

            'description.min' => 'La descripción debe tener al menos 50 caracteres.',

            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',

            'location.max' => 'La ubicación no puede exceder 255 caracteres.',

        ];
    }

}
