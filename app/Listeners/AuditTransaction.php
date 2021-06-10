<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\User;
use App\Models\Transaction;
use App\Events\TransactionCreated;
use App\Events\TransactionDeleted;
use Illuminate\Support\Facades\Log;

class AuditTransaction
{
    public function handle(TransactionCreated|TransactionDeleted $event): void
    {
        $transaction = $event->transaction;

        // Hydrating transaction (delete event cannot pass a deleted model only an array representation),
        if (is_array($transaction)) {
            $user = User::findOrFail($transaction['author_id']);
            $transaction = (new Transaction())->fill($transaction);
            $transaction->user()->associate($user);
        }

        // NB: You might replace this with an audit table or document store such as firebase or fauna db.
        Log::info(sprintf(
            'User with ID %s has %s a transaction with a value of £%0.2f',
            $transaction->user->id,
            $event instanceof TransactionCreated ? 'created' : 'deleted',
            $transaction->amount
        ));
    }
}
