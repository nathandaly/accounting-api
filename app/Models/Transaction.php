<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}