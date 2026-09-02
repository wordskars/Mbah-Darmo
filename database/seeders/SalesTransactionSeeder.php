<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesTransaction;
use App\Models\Menu;
use Carbon\Carbon;

class SalesTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $menus = Menu::all()->keyBy('slug');

        // Demo data: 30 days of transactions
        $salesData = [
            'mie-gepeng-batok-arang-original' => [55, 62, 48, 70, 65, 58, 80, 72, 60, 55, 66, 71, 68, 75, 82, 60, 55, 63, 70, 78, 65, 50, 58, 72, 69, 63, 71, 80, 75, 85],
            'mie-gepeng-pedas-level-3'        => [30, 35, 28, 40, 38, 33, 45, 40, 35, 30, 37, 42, 38, 42, 50, 35, 30, 38, 40, 45, 37, 28, 33, 40, 38, 35, 39, 45, 42, 48],
            'nasi-goreng-arang-mbah-darmo'    => [40, 45, 38, 50, 48, 42, 55, 50, 43, 40, 47, 52, 48, 52, 60, 43, 40, 46, 50, 57, 45, 36, 40, 50, 46, 43, 48, 55, 52, 58],
            'oseng-kikil-koyor-pedas'         => [8, 10, 7, 12, 11, 9, 14, 12, 10, 8, 11, 13, 11, 13, 15, 10, 8, 11, 13, 14, 11, 7, 9, 12, 11, 10, 12, 14, 13, 15],
            'babat-gongso-semarangan'         => [12, 14, 10, 16, 15, 12, 18, 16, 13, 12, 15, 17, 15, 17, 20, 13, 12, 15, 17, 19, 15, 10, 13, 17, 15, 13, 16, 19, 17, 20],
            'mendoan-tempe-mbah-darmo'        => [5, 6, 4, 7, 6, 5, 8, 7, 5, 4, 6, 7, 6, 7, 9, 5, 4, 6, 7, 8, 6, 4, 5, 7, 6, 5, 6, 8, 7, 9],
            'kopi-manual-brew-arang'          => [25, 28, 22, 32, 30, 26, 35, 31, 26, 24, 29, 33, 30, 33, 38, 26, 24, 29, 33, 36, 30, 22, 26, 32, 29, 26, 31, 36, 33, 38],
            'kopi-tubruk-mbah-darmo'          => [18, 20, 16, 22, 21, 18, 25, 22, 18, 17, 21, 23, 21, 23, 27, 18, 17, 21, 23, 26, 21, 16, 18, 23, 21, 18, 22, 25, 23, 27],
            'wedang-uwuh-mbah-darmo'          => [10, 12, 9, 14, 13, 11, 16, 14, 11, 10, 13, 15, 13, 15, 17, 11, 10, 13, 15, 16, 13, 9, 11, 14, 13, 11, 14, 16, 15, 17],
            'es-teh-tarik-gula-aren'          => [15, 17, 13, 20, 18, 15, 22, 20, 16, 14, 18, 21, 18, 21, 24, 16, 14, 18, 21, 23, 18, 13, 16, 20, 18, 15, 19, 22, 20, 24],
        ];

        foreach ($salesData as $slug => $dailySales) {
            if (!isset($menus[$slug])) continue;
            $menu = $menus[$slug];
            foreach ($dailySales as $dayOffset => $qty) {
                $date = Carbon::today()->subDays(29 - $dayOffset);
                SalesTransaction::firstOrCreate(
                    ['menu_id' => $menu->id, 'transaction_date' => $date->toDateString()],
                    [
                        'menu_id'          => $menu->id,
                        'quantity_sold'    => $qty,
                        'revenue'          => $qty * $menu->price,
                        'transaction_date' => $date->toDateString(),
                    ]
                );
            }
        }
    }
}
