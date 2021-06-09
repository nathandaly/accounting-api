<?php

namespace App\Http\Requests;

class AddTransactionRequest extends FeedbackFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'type' => 'required|string|in:income,expense',
            'user.id' => 'required|exists:users,id'
        ];
    }
}
