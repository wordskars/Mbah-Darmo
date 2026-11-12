<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promotion;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus = Menu::with('category')->where('is_featured', true)->where('is_available', true)->take(6)->get();
        $activePromotions = Promotion::active()
            ->where(function ($query) {
                $query->whereNull('valid_until')
                    ->orWhere('valid_until', '>=', now()->toDateString());
            })
            ->latest()
            ->get();

        return view('home.index', compact('featuredMenus', 'activePromotions'));
    }
}
