<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Events\TransactionCreated;
use App\Events\TransactionDeleted;
use App\Http\Filters\TransactionFilter;
use App\Http\Requests\AddTransactionRequest;
use App\Http\Requests\ListTransactionRequest;
use App\Http\Requests\DeleteTransactionRequest;

class TransactionController extends Controller
{
    public function index(ListTransactionRequest $request, TransactionFilter $filter): JsonResponse
    {
        $transactions = Transaction::filter($filter)->get();

        return response()->json($transactions);
    }

    public function store(AddTransactionRequest $request): JsonResponse
    {
        $transaction = null;

        DB::transaction(function () use ($request, &$transaction) {
            $user = User::find($request->input('user.id'));
            $transaction = (new Transaction())->fill($request->all());
            $transaction->user()->associate($user);
            $transaction->save();
        }, 3);

       TransactionCreated::dispatchIf($transaction->exists, $transaction);

        return response()->json([
            'success' => $transaction->exists,
        ], JsonResponse::HTTP_CREATED);
    }

    public function destroy(DeleteTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        DB::transaction(function () use ($transaction) {
            $transaction->delete();
        });

        TransactionDeleted::dispatchIf(!$transaction->exists, $transaction);

        return response()->json([
            'success' => !$transaction->exists,
        ]);
    }
}
