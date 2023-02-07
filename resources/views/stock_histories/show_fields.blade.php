<table class = "table table-striped table-bordered">
    <tr>
      <th>Description</th>
      <th>Details</th>
    </tr>
    <tr>
      <td> Item Name</td>
      <td>{{\App\Models\Item::find($stockHistory->item_name)->name}}</td>
    </tr>
    <tr>
      <td>Category</td>
      <td>{{ \App\Models\Category::find($stockHistory->category_name)->name}}</td>
    </tr>
    <tr>
        <td>Stock Type</td>
        <td class="m-2 <?php echo ($stockHistory->type=='Initial stock') ? 'badge bg-warning' : 'badge bg-success'; ?> ">{{ $stockHistory->type }}</td>
    </tr>
    <tr>

      <td>Quantity</td>
      <td>{{ $stockHistory->quantity }}</td>
    </tr>

    <tr>
      <td>Created At</td>
      <td>{{ $stockHistory->created_at }}</td>
    </tr>
    <tr>
      <td>Updated At</td>
      <td>{{ $stockHistory->updated_at }}</td>
    </tr>
  </table>
