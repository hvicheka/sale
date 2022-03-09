<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use Carbon\Carbon;

class HomeController
{
    public function index()
    {
        $start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');
        $total = Sale::query()
            ->whereBetween('date', [$start_date, $end_date]);

        $total_purchase_price = $total->sum('purchase_price');
        $total_sale_price = $total->sum('price');
        $total_profit = $total_sale_price - $total_purchase_price;
        return view('home', compact('total_purchase_price', 'total_sale_price', 'total_profit'));
    }
}
