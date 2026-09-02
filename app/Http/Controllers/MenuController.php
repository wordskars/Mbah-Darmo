<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['menus' => function ($q) {
            $q->where('is_available', true);
        }])->get();

        $query = Menu::with('category')->where('is_available', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $menus = $query->orderBy('is_featured', 'desc')->get();

        return view('menu.index', compact('menus', 'categories'));
    }
}
