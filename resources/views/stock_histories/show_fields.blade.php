<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $stockHistory->id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user', 'User:') !!}
    <p>{{ \App\Models\User::find($stockHistory->user)->name }}</p>
</div>

<!-- Item Name Field -->
<div class="col-sm-12">
    {!! Form::label('item_name', 'Item Name:') !!}
    <p>{{ \App\Models\Item::find($stockHistory->item_name)->name}}</p>
</div>

<!-- Category Name Field -->
<div class="col-sm-12">
    {!! Form::label('category_name', 'Category Name:') !!}
    <p>{{ \App\Models\Category::find($stockHistory->category_name)->name}}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $stockHistory->quantity }}</p>
</div>

<!-- Date Added Field -->
<div class="col-sm-12">
    {!! Form::label('date_added', 'Date Added:') !!}
    <p>{{ $stockHistory->date_added }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $stockHistory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $stockHistory->updated_at }}</p>
</div>

