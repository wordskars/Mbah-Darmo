<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->paginate(15);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'discount_type' => 'nullable|in:percentage,fixed,bundling',
            'discount_value'=> 'nullable|string',
            'banner_image'  => 'nullable|image|max:3072',
            'is_active'     => 'boolean',
            'valid_until'   => 'nullable|date',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['source']    = 'manual';

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('promotions', 'public');
        }

        Promotion::create($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'discount_type' => 'nullable|in:percentage,fixed,bundling',
            'discount_value'=> 'nullable|string',
            'banner_image'  => 'nullable|image|max:3072',
            'is_active'     => 'boolean',
            'valid_until'   => 'nullable|date',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('banner_image')) {
            if ($promotion->banner_image) Storage::disk('public')->delete($promotion->banner_image);
            $validated['banner_image'] = $request->file('banner_image')->store('promotions', 'public');
        }

        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Promotion $promotion)
    {
        if ($promotion->banner_image) Storage::disk('public')->delete($promotion->banner_image);
        $promotion->delete();
        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promo berhasil dihapus!');
    }
}
