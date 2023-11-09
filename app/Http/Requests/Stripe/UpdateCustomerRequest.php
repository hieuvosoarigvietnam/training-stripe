<?php

namespace App\Http\Requests\Stripe;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
           'address' => [
               'city' => 'nullable',
               'country' => 'nullable',
               'line1' => 'nullable',
               'line2' => 'nullable',
               'postal_code' => 'nullable',
               'state' => 'nullable',
           ],
            'description' => 'nullable',
            'email' => 'nullable',
            'discount' => 'nullable',
            'phone' => 'nullable',
            'shipping' => [
                'address' => [
                    'city' => 'nullable',
                    'country' => 'nullable',
                    'line1' => 'nullable',
                    'line2' => 'nullable',
                    'postal_code' => 'nullable',
                    'state' => 'nullable',
                ],
                'name' => 'nullable',
                'phone' => 'nullable',
            ],
        ];
    }
}
