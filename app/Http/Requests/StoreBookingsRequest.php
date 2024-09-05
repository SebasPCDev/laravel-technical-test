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
            //
            'tour_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'status' => ['required', Rule::in(['pending'])],
            'reservation_date' => ['required', 'date'],
            'number_of_people' => ['required', 'numeric'],
        ];
    }
}
