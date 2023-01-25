<!-- Item Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_name', 'Item Name:') !!}
    {!! Form::select('item_name', $items, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Restock Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('restock_qty', 'Restock Qty:') !!}
    {!! Form::number('restock_qty', null, ['class' => 'form-control']) !!}
</div>
