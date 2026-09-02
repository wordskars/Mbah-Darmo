<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 30);

        $transactions = SalesTransaction::with('menu')
            ->where('transaction_date', '>=', now()->subDays($period))
            ->orderByDesc('transaction_date')
            ->paginate(20);

        // Summary stats
        $totalRevenue = SalesTransaction::where('transaction_date', '>=', now()->subDays($period))->sum('revenue');
        $totalQty     = SalesTransaction::where('transaction_date', '>=', now()->subDays($period))->sum('quantity_sold');

        // Top products in period
        $topProducts = DB::table('sales_transactions')
            ->join('menus', 'menus.id', '=', 'sales_transactions.menu_id')
            ->select('menus.name', DB::raw('SUM(sales_transactions.quantity_sold) as total_sold'), DB::raw('SUM(sales_transactions.revenue) as total_revenue'))
            ->where('sales_transactions.transaction_date', '>=', now()->subDays($period))
            ->groupBy('menus.id', 'menus.name')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        $menus = Menu::where('is_available', true)->get();

        return view('admin.sales.index', compact('transactions', 'totalRevenue', 'totalQty', 'topProducts', 'menus', 'period'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id'          => 'required|exists:menus,id',
            'quantity_sold'    => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'notes'            => 'nullable|string|max:255',
        ]);

        $menu = Menu::find($validated['menu_id']);
        $validated['revenue'] = $menu->price * $validated['quantity_sold'];

        SalesTransaction::create($validated);

        return redirect()->route('admin.sales.index')
            ->with('success', 'Transaksi berhasil dicatat!');
    }
}
