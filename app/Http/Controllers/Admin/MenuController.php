<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    protected FirebaseService $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

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

        // 1. Upload ke Firebase Storage & dapatkan Public URL jika ada file gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $this->firebaseService->uploadMenuImage($request->file('image'));
        } else {
            $validated['image'] = null;
        }

        // 2. Simpan ke database MySQL
        $menu = Menu::create($validated);

        // 3. Simpan data & public URL gambar ke Cloud Firestore
        $this->firebaseService->syncMenuToFirestore($menu);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan dan disinkronkan ke Firebase!');
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

        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari Firebase Storage / lokal jika ada
            if ($menu->image) {
                $this->firebaseService->deleteImage($menu->image);
            }
            // Upload gambar baru ke Firebase Storage dan dapatkan URL-nya
            $validated['image'] = $this->firebaseService->uploadMenuImage($request->file('image'));
        }

        // Update database MySQL
        $menu->update($validated);

        // Sinkronisasi data yang diperbarui ke Cloud Firestore
        $this->firebaseService->syncMenuToFirestore($menu);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diperbarui dan disinkronkan ke Firebase!');
    }

    public function destroy(Menu $menu)
    {
        // Hapus file gambar dari Firebase Storage jika ada
        if ($menu->image) {
            $this->firebaseService->deleteImage($menu->image);
        }

        // Hapus dokumen dari Cloud Firestore
        $this->firebaseService->deleteMenuFromFirestore($menu->id);

        // Hapus dari database MySQL
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus dari sistem dan Firebase!');
    }
}
