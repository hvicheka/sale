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
            $("#date").datepicker({
                dateFormat: 'dd-mm-yy',
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
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

