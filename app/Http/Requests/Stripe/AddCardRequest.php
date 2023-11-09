<?php

namespace App\Http\Requests\Stripe;

use Illuminate\Foundation\Http\FormRequest;

class AddCardRequest extends FormRequest
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
            'number' => 'required|numeric',
            'exp_month' => 'required|numeric|digits:2|between:1,12',
            'exp_year' => 'required|numeric|digits:4|after_or_equal:'.date('Y'),
            'cvc' => 'required|numeric'
        ];
    }
}
