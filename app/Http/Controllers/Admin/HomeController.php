<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index(Request $request)
    {
        $start_date = $request->get('start_date') ?? Carbon::now()->startOfMonth()->format('d-m-Y');
        $end_date = $request->get('end_date') ?? Carbon::now()->format('d-m-Y');

        $start_date_filter = Carbon::createFromFormat('m-d-Y', $start_date)->format('Y-m-d');
        $end_date_filter = Carbon::createFromFormat('m-d-Y', $end_date)->format('Y-m-d');
        $total = Sale::query()
            ->whereBetween('date', [$start_date_filter, $end_date_filter]);

        $total_purchase_price = $total->sum('purchase_price');
        $total_sale_price = $total->sum('price');
        $total_profit = $total_sale_price - $total_purchase_price;

        $chart_data = $total->select(['date', 'purchase_price', 'price'])
            ->get();
        return view('home', compact('total_purchase_price', 'total_sale_price', 'total_profit', 'chart_data'));
    }
}
