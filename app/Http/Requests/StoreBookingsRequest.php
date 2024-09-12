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
            'tour_id' => ['required', 'uuid', 'exists:tours,id'],
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'status' => ['required', Rule::in(['pending'])],
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:10'],
        ];

    }

    public function messages(): array
    {
        return [
            'tour_id.required' => 'El ID del tour es obligatorio.',
            'tour_id.exists' => 'El tour seleccionado no es válido.',
            'tour_id.uuid' => 'El id del tour es obligatorio y debe ser un UUID válido.',

            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'user_id.uuid' => 'El id del usuario es obligatorio y debe ser un UUID válido.',

            'status.required' => 'El estado de la reserva es obligatorio.',
            'status.in' => 'El estado de la reserva debe ser pending.',

            'reservation_date.required' => 'La fecha de reserva es obligatoria.',
            'reservation_date.date' => 'La fecha de reserva no es válida.',
            'reservation_date.after_or_equal' => 'La fecha de reserva debe ser hoy o una fecha futura.',

            'number_of_people.required' => 'El número de personas es obligatorio.',
            'number_of_people.integer' => 'El número de personas debe ser un número entero.',
            'number_of_people.min' => 'Debe haber al menos una persona en la reserva.',
            'number_of_people.max' => 'No puedes reservar para más de 10 personas.',
        ];
    }




}
