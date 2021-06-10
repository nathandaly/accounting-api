<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class DeleteTransactionRequest extends FeedbackFormRequest
{
    public function authorize(): bool
    {
        return Auth::user()?->tokenCan('transaction:delete') ?? false;
    }

    public function rules(): array
    {
        return [];
    }
}
