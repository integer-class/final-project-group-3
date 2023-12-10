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
                    <th width="30%" >Time</th>
                    <th>Activity</th>
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
                url: 'model.php?halaman=history',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: 'waktu'
                },
                {
                    data: 'Activity'
                },
                
            ]
        });
    });
    </script>

   
</body>

</html>