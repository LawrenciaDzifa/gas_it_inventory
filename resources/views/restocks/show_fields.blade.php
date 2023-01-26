{{-- <!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $restock->id }}</p>
</div>

<!-- Item Name Field -->
<div class="col-sm-12">
    {!! Form::label('item_name', 'Item Name:') !!}
    <p>{{ \App\Models\Item::find($restock->item_name)->name}}</p>
</div>

<!-- Restock Qty Field -->
<div class="col-sm-12">
    {!! Form::label('restock_qty', 'Restock Qty:') !!}
    <p>{{ $restock->restock_qty }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $restock->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $restock->updated_at }}</p>
</div> --}}


<table class = "table table-striped table-bordered">
    <tr>
      <th>Description</th>
      <th>Details</th>
    </tr>
    <tr>
      <td> Item Name</td>
      <td>{{\App\Models\Item::find($restock->item_name)->name}}</td>
    </tr>
    <tr>
      <td>Restock Quantity</td>
      <td>{{ $restock->restock_qty }}</td>
    </tr>
    <tr>
      <td>Created At</td>
      <td>{{ $restock->created_at }}</td>
    </tr>
    <tr>
      <td>Updated At</td>
      <td>{{ $restock->updated_at }}</td>
    </tr>
  </table>

