<!-- Item Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_name', 'Item Name:') !!}
    {!! Form::select('item_name', $items, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Serial Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('serial_number', 'Serial Number:') !!}
    {!! Form::text('serial_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Assigned Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qty_assigned', 'Qty Assigned:') !!}
    {!! Form::number('qty_assigned', null, ['class' => 'form-control']) !!}
</div>

<!-- Assigned To Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assigned_to', 'Assigned To:') !!}
    {!! Form::text('assigned_to', null, ['class' => 'form-control']) !!}
</div>
