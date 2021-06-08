<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AddTransactionRequest;

class TransactionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Transaction::get());
    }

    public function store(AddTransactionRequest $request): JsonResponse
    {
        return response()->json(['success' => true,]);
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json(['success' => true,]);
    }
}
