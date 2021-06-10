<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\User;
use App\Models\Transaction;
use Swift_TransportException;
use App\Mail\TransactionAdded;
use App\Mail\TransactionRemoved;
use App\Events\TransactionCreated;
use App\Events\TransactionDeleted;
use Illuminate\Support\Facades\Mail;

class SendEmailTransactionNotification
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

        // NB: These won't actually send and the email templates are blank but just for demo.
        if ($transaction->user->hasVerifiedEmail()) {
            try {
                Mail::to($transaction->user)
                    ->send(
                        $event instanceof TransactionCreated
                            ? new TransactionAdded($transaction)
                            : new TransactionRemoved($transaction)
                    );
            } catch (Swift_TransportException) {}
        }
    }
}
