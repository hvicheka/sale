@extends('layouts.admin')
@section('content')
    @can('sale_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.sales.create") }}">
                    Add Sale
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            Sale List
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sales.index') }}" id="filter_form">
                <div class="row">
                    <div class="col-2">
                        <input type="text" id="start_date" value="{{$start_date}}" class="form-control"
                               name="stat_date">
                    </div>
                    <div class="col-2">
                        <input type="text" id="end_date" value="{{ $end_date }}" class="form-control" name="end_date">
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Meal">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Profit</th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td>
                                {{ ++$loop->index }}
                            </td>
                            <td>
                                {{ $sale->name ?? '' }}
                            </td>
                            <td>
                                {{ $sale->date->format('m-d-Y') }}
                            </td>
                            <td class="category-name">
                                {{ $sale->customer->name ?? '' }}
                            </td>
                            <td>
                                {{ number_format($sale->price, 2)." $"}}
                            </td>
                            <td>
                                {{number_format($sale->purchase_price, 2)." $" }}
                            </td>
                            <td>
                                {{ number_format($sale->price - $sale->purchase_price, 2)." $" }}
                            </td>

                            <td>

                                @can('sale_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sales.show', $sale->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sale_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.sales.edit', $sale->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sale_delete')
                                    <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                               value="Delete">
                                    </form>
                                @endcan

                            </td>
                        </tr>
                        @if($loop->last)
                            <tr>
                                <td colspan="4" class="text-right">Total</td>
                                <td>{{ number_format($total_purchase_price, 2)." $"}}</td>
                                <td>{{ number_format($total_sale_price, 2)." $" }}</td>
                                <td>{{ number_format($total_profit, 2)." $" }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr class="empty-message">
                            <td colspan="8" class="text-center">
                                No data found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
                <div class="d-flex justify-content-center">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $("#start_date").datepicker({
                dateFormat: 'dd-mm-yy',
            });
            $("#end_date").datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $("#start_date").on("change", function () {
                $(this).attr('value', $(this).val())
            });
            $("#end_date").on("change", function () {
                $(this).attr('value', $(this).val())
            });

            $('#filter_form').submit(function (e) {
                e.preventDefault()
                const start_date = $('#start_date').val()
                const end_date = $('#end_date').val()
                window.location.href = `{{ route('admin.sales.index') }}?start_date=${start_date}&end_date=${end_date}`
            })
        });
    </script>
@endsection
