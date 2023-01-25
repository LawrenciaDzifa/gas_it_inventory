<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $requisition->id }}</p>
</div>

<!-- User Field -->
<div class="col-sm-12">
    {!! Form::label('user', 'User:') !!}
    <p>{{ \App\Models\User::find($requisition->user)->name }}</p>
</div>

<!-- Item Name Field -->
<div class="col-sm-12">
    {!! Form::label('item_name', 'Item Name:') !!}
    <p>{{ \App\Models\Item::find($requisition->item_name)->name}}</p>
</div>

<!-- Qty Requested Field -->
<div class="col-sm-12">
    {!! Form::label('qty_requested', 'Qty Requested:') !!}
    <p>{{ $requisition->qty_requested }}</p>
</div>

<!-- Msg Field -->
<div class="col-sm-12">
    {!! Form::label('msg', 'Msg:') !!}
    <p>{{ $requisition->msg }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $requisition->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $requisition->updated_at }}</p>
</div>

