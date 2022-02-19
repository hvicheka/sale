@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Show Sale
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sales.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $sale->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $sale->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Customer Name
                        </th>
                        <td>
                            {{ $sale->customer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Purchase Price
                        </th>
                        <td>
                            {{ $sale->purchase_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Sale Price
                        </th>
                        <td>
                            {{ $sale->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Profit
                        </th>
                        <td>
                            {{ $sale->profit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{ $sale->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Note
                        </th>
                        <td>
                            {{ $sale->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meal.fields.photo') }}
                        </th>
                        <td>
                            @if($sale->photo)
                                <a href="{{ $sale->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $sale->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sales.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
