<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $item->id }}</p>

</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $item->name }}</p>
</div>

<!-- Category Field -->
<div class="col-sm-12">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ \App\Models\Category::find($item->category)->name}}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $item->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $item->updated_at }}</p>
</div>

