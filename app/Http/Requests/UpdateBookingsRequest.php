<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingsRequest extends FormRequest
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
                'status' => ['string', 'in:pending,approved,cancelled'],
            ];
        } else {
            return [
                'status' => ['sometimes', 'string', 'in:pending,confirmed,cancelled'],
            ];
        }

    }

    public function messages(): array
    {
        return [
            'status.in' => 'El estado de la reserva debe ser "pending", "confirmed" o "cancelled".',
        ];
    }
}
