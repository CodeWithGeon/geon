<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class IncreaseStockRequest extends FormRequest
{
 /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       
        return true;
    }


    public function rules(): array
    {
        return [
            'amount' => 'required|integer|min:1',
        ];
    }


    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Please provide an amount to increase.',
            'amount.integer' => 'Amount must be an integer.',
            'amount.min' => 'Amount must be at least 1.',
        ];
    }
}
