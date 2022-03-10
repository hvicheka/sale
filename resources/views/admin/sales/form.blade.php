<div class="form-group">
    <label class="required" for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
           value="{{ old('name', $sale->name) }}">
    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <span class="help-block">{{ trans('cruds.meal.fields.name_helper') }}</span>
</div>
<div class="form-group">
    <label class="required" for="customer_id">Customer</label>
    <select class="form-control select2 @error('customer_id') is-invalid @enderror" name="customer_id"
            id="customer_id">
        <option value="">Select Customer</option>
        @foreach($customers as  $customer)
            <option
                value="{{ $customer->id }}"
                {{ (old('customer_id') || $sale->customer_id) == $customer->id ? 'selected' : '' }}
            >{{ $customer->name }}</option>
        @endforeach
    </select>
    @error('customer_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label class="required" for="purchase_price">Purchase Price</label>
    <input class="form-control  @error('purchase_price') is-invalid @enderror" type="number" name="purchase_price"
           id="purchase_price"
           value="{{ old('purchase_price', $sale->purchase_price) }}">
    @error('purchase_price')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label class="required" for="price">Sale Price</label>
    <input class="form-control  @error('price') is-invalid @enderror" type="number" name="price" id="price"
           value="{{ old('price', $sale->price) }}" step="0.01">
    @error('price')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label class="required" for="date">Date</label>
    <input class="form-control  @error('date') is-invalid @enderror" type="text" name="date" id="date"
           value="{{ old('price', $date) }}">
    @error('date')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
              id="description">{{ old('description', $sale->description) }}</textarea>
    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="note">Note</label>
    <textarea class="form-control @error('note') is-invalid @enderror" name="note"
              id="note">{{ old('note', $sale->note) }}</textarea>
    @error('note')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" id="image" class="form-control">
</div>
<div class="form-group">
    <a href="{{ asset('images/' . $sale->image) }}" target="_blank">
        <img src="{{ asset('images/' . $sale->image) }}" id="preview-image" class="img-thumbnail" width="250">
    </a>
</div>

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
