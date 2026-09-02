<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promotion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus   = Menu::with('category')->where('is_featured', true)->where('is_available', true)->take(6)->get();
        $activePromotions = Promotion::active()->latest()->take(3)->get();

        return view('home.index', compact('featuredMenus', 'activePromotions'));
    }
}
