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
        <!-- <a href="index.php?halaman=peminjaman" style="margin-bottom: 50px; float:left"
            class="btn btn_primary">Tambah Peminjaman</a> -->
        <table style="width: 100%; text-align-last: center;" id="data-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Loaner Name</th>
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>Loan date</th>
                    <th>Return date</th>
                    <th>Status</th>
                    <th>Quantity</th>
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
                url: 'model.php?halaman=peminjaman',
                type: 'GET',
                dataSrc: ''
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'nama_peminjam'
                },
                {
                    data: 'category'
                },
                {
                    data: 'nama_item'
                },
                {
                    data: 'tanggal_pinjam'
                },
                {
                    data: 'tanggal_kembali'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        var today = new Date().toISOString().split('T')[0];
                        console.log(today);
                        var returnDate = data.tanggal_kembali.split(' ')[0];

                        if (data.status_peminjaman == 'Active' && today >= data
                            .tanggal_kembali) {
                            return '<span class="red-cell">Overdue</span>';
                        } else if (data.status_peminjaman == 'Returned') {
                            return '<span class="red-blue">Returned</span>';
                        } else if (data.status_peminjaman == 'Active') {
                            return '<span class="red-active">Active</span>';
                        }
                    }
                },
                {
                    data: 'jumlah_peminjaman'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        var itemId = row.id_peminjaman;
                        return '<div class="actions">' +
                            '<a class="btn btn-primary btn-small material-icons" style="margin-left : 10px" id="openModalBtn" href="model.php?halaman=selesai&id=' +
                            itemId + '">done</a>' +
                            '</div>';
                    }
                }
            ]
        });
    });
    </script>

    <style>
    .red-cell {
        color: red;
    }

    .red-blue {
        color: blue;
    }

    .red-active {
        color: green;
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('myModal');
        var btn = document.getElementById('openModalBtn');
        var span = document.getElementsByClassName('close')[0];
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        btn.onclick = function() {
            modal.style.display = 'block';
        };

        span.onclick = function() {
            modal.style.display = 'none';
        };

        confirmDeleteBtn.onclick = function() {
            // Tambahkan logika penghapusan di sini
            console.log('Item deleted!');
            modal.style.display = 'none'; // Sembunyikan modal setelah penghapusan
        };

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    });
    </script>
</body>

</html>