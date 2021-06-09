<?php

declare(strict_types=1);

namespace App\Listeners;

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

        // NB: These won't actually send and the email templates are blank but just for demo.
        if ($event->transaction->user->hasVerifiedEmail()) {
            Mail::to($transaction->user)
                ->send(
                    $event instanceof TransactionCreated
                        ? new TransactionAdded($transaction)
                        : new TransactionRemoved($transaction)
                );
        }
    }
}
