<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingsRequest extends FormRequest
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
            'tour_id' => ['required', 'integer', 'exists:tours,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', Rule::in(['pending', 'confirmed', 'cancelled'])],
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:10'],
        ];

    }

    public function messages(): array
    {
        return [
            'tour_id.required' => 'El ID del tour es obligatorio.',
            'tour_id.integer' => 'El ID del tour debe ser un número entero.',
            'tour_id.exists' => 'El tour seleccionado no es válido.',

            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.integer' => 'El ID del usuario debe ser un número entero.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',

            'status.required' => 'El estado de la reserva es obligatorio.',
            'status.in' => 'El estado de la reserva debe ser "pending", "confirmed" o "cancelled".',

            'reservation_date.required' => 'La fecha de reserva es obligatoria.',
            'reservation_date.date' => 'La fecha de reserva no es válida.',
            'reservation_date.after_or_equal' => 'La fecha de reserva debe ser hoy o una fecha futura.',

            'number_of_people.required' => 'El número de personas es obligatorio.',
            'number_of_people.integer' => 'El número de personas debe ser un número entero.',
            'number_of_people.min' => 'Debe haber al menos una persona en la reserva.',
            'number_of_people.max' => 'No puedes reservar para más de 10 personas.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tour_id' => (int) $this->tour_id,
            'user_id' => (int) $this->user_id,
            'number_of_people' => (int) $this->number_of_people,
            'reservation_date' => $this->formatDate($this->reservation_date),
        ]);
    }

    private function formatDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }


}
