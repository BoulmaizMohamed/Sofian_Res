<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RevenueEntry extends Model
{
    protected $fillable = [
        'type',
        'category',
        'amount',
        'description',
        'entry_date',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'amount'     => 'decimal:2',
    ];

    /* ── Category lists ─────────────────────────── */

    public static array $revenueCategories = [
        'Beach Rental',
        'Room Booking Fee',
        'Service Charge',
        'Food & Beverage',
        'Equipment Rental',
        'Other Income',
    ];

    public static array $expenseCategories = [
        'Staff Salaries',
        'Maintenance',
        'Supplies',
        'Utilities',
        'Marketing',
        'Insurance',
        'Other Expense',
    ];

    /* ── Query Scopes ───────────────────────────── */

    public function scopeRevenues(Builder $q): Builder
    {
        return $q->where('type', 'revenue');
    }

    public function scopeExpenses(Builder $q): Builder
    {
        return $q->where('type', 'expense');
    }

    public function scopeForDate(Builder $q, string $date): Builder
    {
        return $q->whereDate('entry_date', $date);
    }

    public function scopeForMonth(Builder $q, int $year, int $month): Builder
    {
        return $q->whereYear('entry_date', $year)->whereMonth('entry_date', $month);
    }

    public function scopeForYear(Builder $q, int $year): Builder
    {
        return $q->whereYear('entry_date', $year);
    }
}
