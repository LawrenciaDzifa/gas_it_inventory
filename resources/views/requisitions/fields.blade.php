<!-- User Id Field -->
    {!! Form::hidden('user', 'User:') !!}
    {!! Form::hidden('user', Auth::id())!!}


<!-- Item Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_name', 'Item Name:') !!}
    {!! Form::select('item_name', $items, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Qty Requested Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qty_requested', 'Qty Requested:') !!}
    {!! Form::number('qty_requested', null, ['class' => 'form-control']) !!}
</div>

<!-- Msg Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('msg', 'Msg:') !!}
    {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
</div>
