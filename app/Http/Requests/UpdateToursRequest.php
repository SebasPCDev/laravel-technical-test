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
        if($method === 'PUT') {
            return [
                'title' => ['string'],
                'description' => ['string'],
                'price' => ['numeric'],
                'location' => ['string'],
                'start_date' => ['date'],
                'end_date' => ['date', 'after:start_date'],
            ];
        }else{
            return [
                'title' => ['sometimes','string'],
                'description' => ['sometimes','string'],
                'price' => ['sometimes','numeric'],
                'location' => ['sometimes','string'],
                'start_date' => ['sometimes','date'],
                'end_date' => ['sometimes','date', 'after:start_date'],
            ];

        }
    }

    protected function prepareForValidation()
    {
        if($this->price){
            $this->merge([
                'price' => (int) $this->price * 100,
            ]);
        }

    }
}
