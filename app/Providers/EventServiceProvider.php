<?php

namespace App\Providers;

use App\Events\TransactionCreated;
use App\Events\TransactionDeleted;
use App\Listeners\AuditTransaction;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailTransactionNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TransactionCreated::class => [
            SendEmailTransactionNotification::class,
            AuditTransaction::class,
        ],
        TransactionDeleted::class => [
            SendEmailTransactionNotification::class,
            AuditTransaction::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
