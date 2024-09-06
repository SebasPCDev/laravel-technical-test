<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'title' => ['string', 'max:255'],
                'description' => ['string', 'min:50'],
                'price' => ['numeric', 'min:0'],
                'location' => ['string', 'max:255'],
                'start_date' => ['date', 'after_or_equal:today'],
                'end_date' => ['date', 'after:start_date'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'string'],
                'description' => ['sometimes', 'string'],
                'price' => ['sometimes', 'numeric'],
                'location' => ['sometimes', 'string'],
                'start_date' => ['sometimes', 'date'],
                'end_date' => ['sometimes', 'date', 'after:start_date'],
            ];

        }
    }

    public function messages(): array
    {
        return [
            'title.max' => 'El título no puede exceder 255 caracteres.',

            'description.min' => 'La descripción debe tener al menos 50 caracteres.',

            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',

            'location.max' => 'La ubicación no puede exceder 255 caracteres.',

            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'start_date.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',

            'end_date.date' => 'La fecha de finalización debe ser una fecha válida.',
            'end_date.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'price' => (int) $this->price,
            'start_date' => date('Y-m-d', strtotime($this->start_date)),
            'end_date' => date('Y-m-d', strtotime($this->end_date)),
        ]);
    }
}
