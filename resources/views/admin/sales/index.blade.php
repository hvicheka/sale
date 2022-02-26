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
            <form action="{{ route('admin.sales.index') }}">
                <input type="text" id="start_date" name="stat_date">
                <input type="text" id="end_date" name="end_date">
                <button class="btn btn-primary btn-sm" type="submit">Submit</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Meal">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
                            <td class="category-name">
                                {{ $sale->customer->name ?? '' }}
                            </td>
                            <td>
                                {{ $sale->purchase_price ?? '' }}
                            </td>
                            <td>
                                {{ $sale->price ?? '' }}
                            </td>
                            <td>
                                {{ $sale->profit ?? '' }}
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
            $("#start_date").datepicker({});
            $("#end_date").datepicker();
        });
    </script>
@endsection
