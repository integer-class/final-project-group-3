
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with Search and Pagination</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   
</head>

<body>
    <div id="table-container">
        <table style="width: 100%; text-align-last: center;" id="data-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        // Menggunakan DataTables
        $('#data-table').DataTable({
            ajax: {
                url: 'model.php?halaman=items',
                type: 'GET',
                dataSrc: ''
            },
            columns: [  
                { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
                {
                    data: 'nama_item'
                },
                {
                    data: 'category'
                },
                {
                    data: 'harga_item'
                },
                {
                    data: 'stock'
                },
                {
                    data: 'deskripsi_item'
                },
                {
    data: null,
    render: function (data, type, row) {
        var itemId = row.id_item;
        return '<div class="actions">' +
            '<a class="btn btn-danger btn-small material-icons" href="model.php?halaman=hapus_item&id=' + itemId + '">delete</a>' +
            '<a class="btn btn-warning btn-small material-icons" style="margin-left : 10px" href="model.php?halaman=hapus_item&id=' + itemId + '">edit</a>' +
            '</div>';
    }
}

            ]
        });
    });

    function deleteItem(itemId) {
        // Your logic for deleting an item with the specified ID
        console.log('Deleting item with ID:', itemId);
        // Add your logic to actually delete the item from the server or perform any other action
    }
    </script>
</body>

</html> 