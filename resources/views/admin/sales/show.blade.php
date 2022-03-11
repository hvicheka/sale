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
                            {{ "$".number_format($sale->purchase_price, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Sale Price
                        </th>
                        <td>
                            {{ "$".number_format($sale->price, 2)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Profit
                        </th>
                        <td>
                            {{ "$".number_format($sale->price - $sale->purchase_price, 2)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Date
                        </th>
                        <td>
                            {{ $sale->date->format('d-m-Y')}}
                        </td>
                    </tr>
                    <tr>

                        <th>
                            Description
                        </th>
                        <td >
                            {!! $sale->description !!}
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
                            Image
                        </th>
                        <td>
                            @if($sale->image)
                                <a href="{{ asset('images/' . $sale->image) }}" target="_blank">
                                    <img src="{{ asset('images/' . $sale->image) }}" width="100px" height="100px">
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
@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
