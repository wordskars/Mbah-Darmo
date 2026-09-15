<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->latest()->paginate(20);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'             => 'required|exists:categories,id',
            'name'                    => 'required|string|max:255',
            'price'                   => 'required|numeric|min:0',
            'short_description_hover' => 'nullable|string|max:500',
            'description'             => 'nullable|string',
            'spice_level'             => 'nullable|in:mild,medium,hot,extra-hot',
            'image'                   => 'nullable|image|max:2048',
            'is_available'            => 'boolean',
            'is_featured'             => 'boolean',
        ]);

        $validated['slug']         = Str::slug($validated['name']) . '-' . Str::random(4);
        $validated['is_available'] = $request->boolean('is_available');
        $validated['is_featured']  = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id'             => 'required|exists:categories,id',
            'name'                    => 'required|string|max:255',
            'price'                   => 'required|numeric|min:0',
            'short_description_hover' => 'nullable|string|max:500',
            'description'             => 'nullable|string',
            'spice_level'             => 'nullable|in:mild,medium,hot,extra-hot',
            'image'                   => 'nullable|image|max:2048',
            'is_available'            => 'boolean',
            'is_featured'             => 'boolean',
        ]);

        $validated['is_available'] = $request->boolean('is_available');
        $validated['is_featured']  = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($menu->image) Storage::disk('public')->delete($menu->image);
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) Storage::disk('public')->delete($menu->image);
        $menu->delete();
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus!');
    }
}
