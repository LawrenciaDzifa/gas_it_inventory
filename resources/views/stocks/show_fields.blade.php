<table class = "table table-striped table-bordered">
    <tr>
      <th>Description</th>
      <th>Details</th>
    </tr>
    <tr>
      <td> Item Name</td>
      <td>{{\App\Models\Item::find($stock->item_name)->name}}</td>
    </tr>
    <tr>
      <td>Category</td>
      <td>{{ \App\Models\Category::find($stock->category_name)->name}}</td>
    </tr>
    <tr>
      <td>Quantity</td>
      <td>{{ $stock->quantity }}</td>
    </tr>
    <tr>
      <td>Created At</td>
      <td>{{ $stock->created_at }}</td>
    </tr>
    <tr>
      <td>Updated At</td>
      <td>{{ $stock->updated_at }}</td>
    </tr>
  </table>
