<table class = "table table-striped table-bordered">
    <tr>
      <th>Description</th>
      <th>Details</th>
    </tr>
    <tr>
      <td> Item Name</td>
      <td>{{ $item->name }}</td>
    </tr>
    <tr>
      <td>Category</td>
      <td>{{ \App\Models\Category::find($item->category)->name}}</td>
    </tr>
    <tr>
      <td>Created At</td>
      <td>{{ $item->created_at }}</td>
    </tr>
    <tr>
      <td>Updated At</td>
      <td>{{ $item->updated_at }}</td>
    </tr>
  </table>
