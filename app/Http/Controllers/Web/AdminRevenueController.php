<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RevenueEntry;
use App\Models\RevenueCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminRevenueController extends Controller
{
    /* ── Index ──────────────────────────────────── */

    public function index(Request $request): View
    {
        $period = $request->query('period', 'monthly'); // daily | monthly | yearly
        $date   = $request->query('date',   today()->toDateString());
        $type   = $request->query('type',   'all'); // all | revenue | expense

        [$year, $month, $day] = explode('-', $date);

        // Build base query for selected period
        $periodQuery = match ($period) {
            'daily'   => RevenueEntry::forDate($date),
            'yearly'  => RevenueEntry::forYear((int)$year),
            default   => RevenueEntry::forMonth((int)$year, (int)$month),
        };

        // Summary totals for the selected period
        $totalRevenue = (clone $periodQuery)->revenues()->sum('amount');
        $totalExpense = (clone $periodQuery)->expenses()->sum('amount');
        $netBalance   = $totalRevenue - $totalExpense;

        // Entries list (with type filter)
        $entriesQuery = match ($period) {
            'daily'   => RevenueEntry::forDate($date),
            'yearly'  => RevenueEntry::forYear((int)$year),
            default   => RevenueEntry::forMonth((int)$year, (int)$month),
        };

        if ($type === 'revenue') {
            $entriesQuery->revenues();
        } elseif ($type === 'expense') {
            $entriesQuery->expenses();
        }

        $entries = $entriesQuery->orderByDesc('entry_date')->orderByDesc('id')->paginate(20)->withQueryString();

        // All-time overall totals (for dashboard-style global summary)
        $overallRevenue = RevenueEntry::revenues()->sum('amount');
        $overallExpense = RevenueEntry::expenses()->sum('amount');
        $overallNet     = $overallRevenue - $overallExpense;

        return view('admin.revenue.index', compact(
            'entries', 'period', 'date', 'type',
            'totalRevenue', 'totalExpense', 'netBalance',
            'overallRevenue', 'overallExpense', 'overallNet'
        ));
    }

    /* ── Create ─────────────────────────────────── */

    public function create(Request $request): View
    {
        $defaultType = $request->query('type', 'revenue');
        $revCats     = RevenueCategory::revenues()->orderBy('name')->pluck('name');
        $expCats     = RevenueCategory::expenses()->orderBy('name')->pluck('name');
        return view('admin.revenue.create', compact('defaultType', 'revCats', 'expCats'));
    }

    /* ── Store ──────────────────────────────────── */

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type'        => 'required|in:revenue,expense',
            'category'    => 'required|string|max:100',
            'amount'      => 'required|numeric|min:0.01|max:99999999.99',
            'description' => 'nullable|string|max:255',
            'entry_date'  => 'required|date',
        ]);

        RevenueEntry::create($data);

        return redirect()->route('admin.revenue.index')
            ->with('success', ucfirst($data['type']) . ' entry added successfully.');
    }

    /* ── Edit ───────────────────────────────────── */

    public function edit(RevenueEntry $entry): View
    {
        $revCats = RevenueCategory::revenues()->orderBy('name')->pluck('name');
        $expCats = RevenueCategory::expenses()->orderBy('name')->pluck('name');
        return view('admin.revenue.edit', compact('entry', 'revCats', 'expCats'));
    }

    /* ── Update ─────────────────────────────────── */

    public function update(Request $request, RevenueEntry $entry): RedirectResponse
    {
        $data = $request->validate([
            'type'        => 'required|in:revenue,expense',
            'category'    => 'required|string|max:100',
            'amount'      => 'required|numeric|min:0.01|max:99999999.99',
            'description' => 'nullable|string|max:255',
            'entry_date'  => 'required|date',
        ]);

        $entry->update($data);

        return redirect()->route('admin.revenue.index')
            ->with('success', 'Entry updated successfully.');
    }

    /* ── Destroy ────────────────────────────────── */

    public function destroy(RevenueEntry $entry): RedirectResponse
    {
        $entry->delete();

        return redirect()->route('admin.revenue.index')
            ->with('success', 'Entry deleted.');
    }
}
