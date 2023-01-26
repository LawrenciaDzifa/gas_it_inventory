<table class = "table table-striped table-bordered">
    <tr>
      <th>Description</th>
      <th>Details</th>
    </tr>
    <tr>
      <td> User</td>
      <td>{{ \App\Models\User::find($requisition->user)->name }}</td>
    </tr>
    <tr>
      <td> Item Name</td>
      <td>{{\App\Models\Item::find($requisition->item_name)->name}}</td>
    </tr>
    <tr>
      <td>Quantity Requested</td>
      <td>{{ $requisition->qty_requested }}</td>
    </tr>
    <tr>
      <td>Message</td>
      <td>{{ $requisition->msg}}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td <?php if ($requisition->status=="pending") {
            echo"class='badge bg-warning m-2'";
        } elseif($requisition->status=="approved") {
            echo"class='badge bg-success m-2'";
        }else{
            echo"class='badge bg-danger m-2'";
        }
         ?> >{{ $requisition->status }}</td>
    </tr>
    <tr>
      <td>Created At</td>
      <td>{{ $requisition->created_at }}</td>
    </tr>
    <tr>
      <td>Updated At</td>
      <td>{{ $requisition->updated_at }}</td>
    </tr>
  </table>
