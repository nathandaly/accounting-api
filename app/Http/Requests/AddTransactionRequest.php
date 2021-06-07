<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
