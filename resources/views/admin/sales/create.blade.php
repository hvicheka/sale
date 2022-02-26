@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Add Sale
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sales.store") }}" enctype="multipart/form-data">
                @csrf
                @include('admin.sales.form')
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(function () {
            $("#date").datepicker({});
        });
    </script>
@endsection
