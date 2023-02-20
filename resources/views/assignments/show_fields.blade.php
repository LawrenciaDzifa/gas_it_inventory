<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $assignment->id }}</p>
</div>

<!-- Item Name Field -->
<div class="col-sm-12">
    {!! Form::label('item_name', 'Item Name:') !!}
    <p>{{ $assignment->item_name }}</p>
</div>

<!-- Serial Number Field -->
<div class="col-sm-12">
    {!! Form::label('serial_number', 'Serial Number:') !!}
    <p>{{ $assignment->serial_number }}</p>
</div>

<!-- Qty Assigned Field -->
<div class="col-sm-12">
    {!! Form::label('qty_assigned', 'Qty Assigned:') !!}
    <p>{{ $assignment->qty_assigned }}</p>
</div>

<!-- Assigned To Field -->
<div class="col-sm-12">
    {!! Form::label('assigned_to', 'Assigned To:') !!}
    <p>{{ $assignment->assigned_to }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $assignment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $assignment->updated_at }}</p>
</div>

