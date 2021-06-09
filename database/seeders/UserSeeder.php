<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @throws \Exception
     */
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->create()
            ->each(
                fn (User $user) => Transaction::factory([
                        'author_id' => $user->id,
                    ])
                    ->count(random_int(0, 24))
                    ->create()
            );
        User::factory([
                'email' => 'test@pilon.co.uk'
            ])
            ->count(1)
            ->create()
            ->each(
                fn (User $user) => Transaction::factory([
                    'author_id' => $user->id,
                ])
                    ->count(random_int(0, 24))
                    ->create()
            );
    }
}
