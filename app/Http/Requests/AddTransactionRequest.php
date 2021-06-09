<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class AddTransactionRequest extends FeedbackFormRequest
{
    public function authorize(): bool
    {
        return Auth::user()?->tokenCan('transaction:add');
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
