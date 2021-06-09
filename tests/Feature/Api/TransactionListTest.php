<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Transaction;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Carbon;

use function Pest\Faker\faker;
use function Pest\Laravel\getJson;
use function PHPUnit\Framework\assertTrue;

beforeEach(
    fn () => Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    )
);

test('List all transactions (by authenticated user)')
    ->get('/api/transactions')
    ->assertOk()
    ->assertJsonStructure([
        '*' => [
            'id',
            'title',
            'amount',
            'type',
            'author_id',
            'created_at',
            'updated_at',
        ]
    ]);

test('List all transactions by "income" type', function () {
   $response = getJson('/api/transactions?type=income');
   $response->assertOk();
   $responseArray = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);
   assertTrue(collect($responseArray)->contains('type', 'income'));
});

test('List all transactions by "expense" type', function () {
    $response = getJson('/api/transactions?type=expense');
    $response->assertOk();
    $responseArray = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);
    assertTrue(collect($responseArray)->contains('type', 'expense'));
});

test('List all transactions by amount range', function () {
    $randomAmount = faker()->randomFloat(2, 20, 21);

    Transaction::factory([
        'author_id' => 1,
        'amount' => $randomAmount,
    ])->count(1)->create();

    $response = getJson('/api/transactions?amount[]=19.9&amount[]=21.4');
    $response->assertOk();
    $responseArray = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

    assertTrue(collect($responseArray)->contains('amount', $randomAmount));
});

test('List all transactions by date range', function () {
    $tomorrow = Carbon::tomorrow();

    Transaction::factory([
        'author_id' => 1,
        'title' => 'Test =ing all transactions by date range',
        'amount' => faker()->randomFloat(2, 0, 12),
        'type' => faker()->randomElement(['income', 'expense']),
        'created_at' => $tomorrow,
        'updated_at' => $tomorrow,
    ])->count(1)->create();

    $response = getJson('/api/transactions?date[]=' . $tomorrow->subDay() . '&date[]=' . $tomorrow->addDay());
    $response->assertOk();
    $responseArray = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);


    assertTrue(collect($responseArray)->contains('created_at', $tomorrow->toISOString()));
});
