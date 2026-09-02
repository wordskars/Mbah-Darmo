<?php

namespace App\Http\Controllers;

use App\Models\FranchisePackage;
use Illuminate\Http\Request;

class FranchiseController extends Controller
{
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
}
