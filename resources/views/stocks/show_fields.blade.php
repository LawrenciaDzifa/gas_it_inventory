<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $stock->id }}</p>
</div>

<!-- Item Name Field -->
<div class="col-sm-12">
    {!! Form::label('item_name', 'Item Name:') !!}
    <p>{{ \App\Models\Item::find($stock->item_name)->name}}</p>
</div>

<!-- Category Name Field -->
<div class="col-sm-12">
    {!! Form::label('category_name', 'Category Name:') !!}
    <p>{{ \App\Models\Category::find($stock->category_name)->name}}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $stock->quantity }}</p>
</div>

<!-- Date Added Field -->
<div class="col-sm-12">
    {!! Form::label('date_added', 'Date Added:') !!}
    <p>{{ $stock->date_added }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $stock->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $stock->updated_at }}</p>
</div>

