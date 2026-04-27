<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RevenueCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminRevenueCategoryController extends Controller
{
    /* ── Index (all categories listed, with inline add form) ── */

    public function index(): View
    {
        $revenues = RevenueCategory::revenues()->orderBy('is_default', 'desc')->orderBy('name')->get();
        $expenses = RevenueCategory::expenses()->orderBy('is_default', 'desc')->orderBy('name')->get();

        return view('admin.revenue.categories', compact('revenues', 'expenses'));
    }

    /* ── Store ────────────────────────────────────────────────── */

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => 'required|in:revenue,expense',
            'name' => [
                'required', 'string', 'max:100',
                // Unique per type
                \Illuminate\Validation\Rule::unique('revenue_categories')->where(fn ($q) => $q->where('type', $request->type)),
            ],
        ], [
            'name.unique' => 'A category with this name already exists for the selected type.',
        ]);

        RevenueCategory::create($data);

        return redirect()->route('admin.revenue.categories')
            ->with('success', 'Category "' . $data['name'] . '" added.');
    }

    /* ── Update (name only — type stays fixed) ────────────────── */

    public function update(Request $request, RevenueCategory $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                \Illuminate\Validation\Rule::unique('revenue_categories')
                    ->where(fn ($q) => $q->where('type', $category->type))
                    ->ignore($category->id),
            ],
        ], [
            'name.unique' => 'A category with this name already exists for this type.',
        ]);

        $category->update(['name' => $data['name']]);

        return redirect()->route('admin.revenue.categories')
            ->with('success', 'Category updated.');
    }

    /* ── Destroy ──────────────────────────────────────────────── */

    public function destroy(RevenueCategory $category): RedirectResponse
    {
        // Check if any entries reference this category name
        $inUse = \App\Models\RevenueEntry::where('category', $category->name)
            ->where('type', $category->type)
            ->exists();

        if ($inUse) {
            return redirect()->route('admin.revenue.categories')
                ->with('error', 'Cannot delete "' . $category->name . '" — it is used by existing entries. Remove those entries first.');
        }

        $category->delete();

        return redirect()->route('admin.revenue.categories')
            ->with('success', 'Category deleted.');
    }
}
