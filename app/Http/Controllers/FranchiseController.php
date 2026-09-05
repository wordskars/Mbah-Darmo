<?php

namespace App\Http\Controllers;

use App\Models\FranchisePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FranchiseController extends Controller
{
    // ==================== PUBLIK ====================

    public function index()
    {
        $packages = FranchisePackage::orderBy('sort_order')->get();
        return view('franchise.index', compact('packages'));
    }

    public function show($slug)
    {
        $package  = FranchisePackage::where('slug', $slug)->firstOrFail();
        $packages = FranchisePackage::orderBy('sort_order')->get(); // for nav between packages
        return view('franchise.show', compact('package', 'packages'));
    }

    // ==================== ADMIN CRUD ====================

    public function create()
    {
        return view('admin.franchise.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                     => 'required|string|max:255',
            'price'                    => 'required|numeric',
            'space_required'           => 'nullable|string|max:255',
            'pax_capacity'             => 'nullable|integer',
            'staff_count'              => 'nullable|integer',
            'roi_projection'           => 'nullable|string|max:255',
            'monthly_revenue_estimate' => 'nullable|string|max:255',
            'description'              => 'required|string',
            'color_accent'             => 'nullable|string|max:7',
            'sort_order'               => 'nullable|integer',
            'hero_image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Maksimal 2MB
        ]);

        // Auto generate slug dari nama paket
        $validated['slug'] = Str::slug($request->name);

        // Upload Gambar Hero jika diinputkan
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('franchises', 'public');
        }

        FranchisePackage::create($validated);

        return redirect()->route('admin.franchise.index')->with('success', 'Paket franchise berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $package = FranchisePackage::findOrFail($id);
        return view('admin.franchise.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = FranchisePackage::findOrFail($id);

        $validated = $request->validate([
            'name'                     => 'required|string|max:255',
            'price'                    => 'required|numeric',
            'space_required'           => 'nullable|string|max:255',
            'pax_capacity'             => 'nullable|integer',
            'staff_count'              => 'nullable|integer',
            'roi_projection'           => 'nullable|string|max:255',
            'monthly_revenue_estimate' => 'nullable|string|max:255',
            'description'              => 'required|string',
            'color_accent'             => 'nullable|string|max:7',
            'sort_order'               => 'nullable|integer',
            'hero_image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->name);

        // Handle Update Gambar Hero
        if ($request->hasFile('hero_image')) {
            // Hapus gambar lama dari storage jika ada
            if ($package->hero_image && Storage::disk('public')->exists($package->hero_image)) {
                Storage::disk('public')->delete($package->hero_image);
            }

            // Simpan gambar baru
            $validated['hero_image'] = $request->file('hero_image')->store('franchises', 'public');
        }

        $package->update($validated);

        return redirect()->route('admin.franchise.index')->with('success', 'Paket franchise berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $package = FranchisePackage::findOrFail($id);

        // Hapus file gambar dari storage saat data dihapus
        if ($package->hero_image && Storage::disk('public')->exists($package->hero_image)) {
            Storage::disk('public')->delete($package->hero_image);
        }

        $package->delete();

        return redirect()->route('admin.franchise.index')->with('success', 'Paket franchise berhasil dihapus!');
    }
}