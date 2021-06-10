<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class ListTransactionRequest extends FeedbackFormRequest
{
    public function authorize(): bool
    {
        return Auth::user()?->tokenCan('transaction:list')?? false;
    }

    public function rules(): array
    {
        return [];
    }
}
