<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RevenueCategory extends Model
{
    protected $fillable = ['type', 'name', 'is_default'];

    protected $casts = ['is_default' => 'boolean'];

    /* ── Scopes ─────────────────────────────────── */

    public function scopeRevenues(Builder $q): Builder
    {
        return $q->where('type', 'revenue');
    }

    public function scopeExpenses(Builder $q): Builder
    {
        return $q->where('type', 'expense');
    }

    public function scopeForType(Builder $q, string $type): Builder
    {
        return $q->where('type', $type);
    }
}
