<?php

declare(strict_types=1);

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TransactionFilter extends Filter
{
    public function type(?string $type = null): Builder
    {
        return $this->builder->where('type', '=', $type);
    }

    public function amount(?array $amounts = null): Builder
    {
        return $this->builder->whereBetween('amount', $amounts);
    }

    public function date(?array $dates = null): Builder
    {
        return $this->builder->whereBetween('created_at', $dates);
    }
}
