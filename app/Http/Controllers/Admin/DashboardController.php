<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Promotion;
use App\Models\SalesTransaction;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus      = Menu::count();
        $totalPromos     = Promotion::active()->count();
        $totalTransactions = SalesTransaction::count();

        // Top selling product
        $topProduct = DB::table('sales_transactions')
            ->join('menus', 'menus.id', '=', 'sales_transactions.menu_id')
            ->select('menus.name', DB::raw('SUM(sales_transactions.quantity_sold) as total'))
            ->groupBy('menus.id', 'menus.name')
            ->orderByDesc('total')
            ->first();

        // Revenue last 30 days
        $recentRevenue = SalesTransaction::where('transaction_date', '>=', now()->subDays(30))
            ->sum('revenue');

        // Weekly sales chart data (last 7 days)
        $weeklySales = SalesTransaction::select(
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('SUM(quantity_sold) as total_qty'),
                DB::raw('SUM(revenue) as total_revenue')
            )
            ->where('transaction_date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top 5 menus this month
        $topMenus = DB::table('sales_transactions')
            ->join('menus', 'menus.id', '=', 'sales_transactions.menu_id')
            ->select('menus.name', DB::raw('SUM(sales_transactions.quantity_sold) as total_sold'), DB::raw('SUM(sales_transactions.revenue) as total_revenue'))
            ->where('sales_transactions.transaction_date', '>=', now()->subDays(30))
            ->groupBy('menus.id', 'menus.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMenus', 'totalPromos', 'totalTransactions',
            'topProduct', 'recentRevenue', 'weeklySales', 'topMenus'
        ));
    }
}
