
<table class = "table table-striped table-bordered">
    <tr>
      <th>Description</th>
      <th>Details</th>
    </tr>
    <tr>
      <td> Item Name</td>
      <td>{{\App\Models\Item::find($assignment->item_name)->name}}</td>
    </tr>
    <tr>
      <td>Serial Number</td>
      <td>{{ $assignment->serial_number }}</td>
    </tr>
    <tr>
      <td>Quantity Assigned</td>
      <td>{{ $assignment->qty_assigned }}</td>
    </tr>
    <tr>
      <td>Assigned To</td>
      <td>{{ $assignment->assigned_to }}</td>
    </tr>
    <tr>
      <td>Created At</td>
      <td>{{ $assignment->created_at }}</td>
    </tr>
    <tr>
      <td>Updated At</td>
      <td>{{ $assignment->updated_at }}</td>
    </tr>

  </table>
