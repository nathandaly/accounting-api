<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

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
   assertTrue(collect($response->decodeResponseJson())->first()->pluck('type')->contains('income'));
});

test('List all transactions by "expense" type', function () {
    $response = getJson('/api/transactions?type=income');
    $response->assertOk();
    assertTrue(collect($response->decodeResponseJson())->first()->pluck('type')->contains('income'));
});

test('List all transactions by amount range', function () {
    assertTrue(false);
});

test('List all transactions by date range', function () {
    assertTrue(false);
});
