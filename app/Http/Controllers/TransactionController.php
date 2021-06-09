<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use App\Http\Filters\TransactionFilter;
use App\Http\Requests\AddTransactionRequest;

class TransactionController extends Controller
{
    public function index(TransactionFilter $filter): JsonResponse
    {
        $transactions = Transaction::filter($filter)->get();

        return response()->json($transactions);
    }

    public function store(AddTransactionRequest $request): JsonResponse
    {
        Transaction::create($request->all())->save();

        return response()->json(['success' => true,]);
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json(['success' => true,]);
    }
}
