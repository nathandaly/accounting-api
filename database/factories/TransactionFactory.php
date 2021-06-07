<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * @throws \Exception
     */
    #[ArrayShape([
        'title' => "string",
        'amount' => "float",
        'type' => "string",
        'created_at' => "string",
        'updated_at' => "string",
    ])]
    public function definition(): array
    {
        $randomDateThisYear = Carbon::today()->subDays(random_int(0, 365));

        return [
            'title' => $this->faker->text(maxNbChars: random_int(12, 24)),
            'amount' => $this->faker->randomFloat(2, 0, 12),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'created_at' => $randomDateThisYear,
            'updated_at' => $randomDateThisYear,
        ];
    }
}
