<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public const TYPE_EXPENSE = 'expense';
    public const TYPE_INCOME = 'income';

    protected $fillable = [
        'title',
        'amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeExpense(Builder $query): Builder
    {
        return $query->where('type', '=', self::TYPE_EXPENSE);
    }

    public function scopeIncome(Builder $query): Builder
    {
        return $query->where('type', '=', self::TYPE_INCOME);
    }
}
