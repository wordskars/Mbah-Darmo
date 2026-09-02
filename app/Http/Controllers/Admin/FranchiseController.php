<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FranchisePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FranchiseController extends Controller
{
    public function index()
    {
        $packages = FranchisePackage::orderBy('sort_order')->get();
        return view('admin.franchise.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.franchise.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                    => 'required|string|max:255',
            'price'                   => 'required|numeric|min:0',
            'space_required'          => 'nullable|string',
            'pax_capacity'            => 'nullable|integer',
            'roi_projection'          => 'nullable|string',
            'description'             => 'nullable|string',
            'monthly_revenue_estimate'=> 'nullable|string',
            'staff_count'             => 'nullable|integer',
            'color_accent'            => 'nullable|string',
            'sort_order'              => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        FranchisePackage::create($validated);

        return redirect()->route('admin.franchise.index')
            ->with('success', 'Paket franchise berhasil ditambahkan!');
    }

    public function edit(FranchisePackage $franchise)
    {
        return view('admin.franchise.edit', compact('franchise'));
    }

    public function update(Request $request, FranchisePackage $franchise)
    {
        $validated = $request->validate([
            'name'                    => 'required|string|max:255',
            'price'                   => 'required|numeric|min:0',
            'space_required'          => 'nullable|string',
            'pax_capacity'            => 'nullable|integer',
            'roi_projection'          => 'nullable|string',
            'description'             => 'nullable|string',
            'monthly_revenue_estimate'=> 'nullable|string',
            'staff_count'             => 'nullable|integer',
            'color_accent'            => 'nullable|string',
            'sort_order'              => 'nullable|integer',
        ]);

        $franchise->update($validated);

        return redirect()->route('admin.franchise.index')
            ->with('success', 'Paket franchise berhasil diperbarui!');
    }

    public function destroy(FranchisePackage $franchise)
    {
        $franchise->delete();
        return redirect()->route('admin.franchise.index')
            ->with('success', 'Paket franchise berhasil dihapus!');
    }
}
