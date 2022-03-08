<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Traits\ImageUploadTrait;
use App\Sale;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $start_date = $request->get('start_date') ?? Carbon::now()->startOfMonth()->format('d-m-Y');
        $end_date = $request->get('end_date') ?? Carbon::now()->format('d-m-Y');

        $start_date_filter = Carbon::createFromFormat('m-d-Y', $start_date)->format('Y-m-d');
        $end_date_filter = Carbon::createFromFormat('m-d-Y', $end_date)->format('Y-m-d');
        $sales = Sale::query()
            ->with(['user', 'customer'])
            ->orderBy('id', 'DESC')
            ->whereDate('date', '>=', $start_date_filter)
            ->whereDate('date', '<=', $end_date_filter)
            ->paginate(20);
        return view('admin.sales.index', compact('sales', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('sale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sale = new Sale();
        $customers = $this->get_customers();
        $date = Carbon::now()->format('m-d-Y');

        return view('admin.sales.create', compact('sale', 'customers', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
//        dd($request->date);
        abort_if(Gate::denies('sale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        auth()->user()->sales()->create([
            "name" => $request->name,
            "purchase_price" => $request->purchase_price,
            "price" => $request->price,
            "date" => $request->date,
            "customer_id" => $request->customer_id,
            "image" => $this->upload($request->file('image')),
            "description" => $request->description,
            "note" => $request->note,
        ]);

        return redirect()->route('admin.sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $customers = $this->get_customers();
        $date = Carbon::createFromFormat('m-d-Y', $sale->date)->format('m-d-Y');
        return view('admin.sales.edit', compact('customers', 'sale', 'date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, Sale $sale)
    {
        $sale->update($request->validated());
        if ($request->file('image')) {
            $imageName = $this->updateImage($sale->image, $request->file('image'));
            $sale->update(['image' => $imageName]);
        }
        return redirect()->route('admin.sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index');
    }

    public function get_customers()
    {
        return User::query()
            ->select(['id', 'name'])
            ->whereHas('roles', function ($query) {
                return $query->where('id', '2');
            })
            ->get();
    }
}
