<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Sertakan library Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with Search and Pagination</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 20%;
        border-radius: 10px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: black;
    }

    .select2-selection__rendered {
        width: -webkit-fill-available;
        padding: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 18px;
    }

    .select2-container--default .select2-selection--single {
        border: 0px solid #aaa;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear {

        display: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 56px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }
    </style>

</head>

<body>
    <div id="table-container">
        <button id="openModalBtn" style="margin-bottom: 50px; float:left" class="btn btn-primary">Add Category</button>
        <table style="width: 100%; text-align-last: center;" id="data-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
    </div>

    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <h2>Add Item</h2>
            <form method="post" action="model.php?halaman=tambah_item">
            <div style="margin-bottom: 30px">
                <div style="margin-bottom: -1px;">
                    <label for="tanggal">Name Item</label>
                </div>
                <select style="width: 350px" name="id_barang" class="select-box form-control" id="mySelect"></select>

                </div>
                <label for="addInputName">Category Item:</label>
                <input disabled type="" id="id"  name="id_category">
                
                <label style="margin-top: 200px" for="addInputName">Item Code:</label>
                <input type="text" id="addInputName" name="nama_category" required>

                <div style="margin-top: 50px;">
                    <button class="btn btn-primary" type="submit">Save</button>

                </div>
            </form>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = 'block';
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = 'none';
    }

    $(document).ready(function() {
        // Menggunakan DataTables
        $('#data-table').DataTable({
            ajax: {
                url: 'model.php?halaman=items',
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
                    data: 'kode_barang'
                },
                {
                    data: 'nama_item'
                },
                {
                    data: 'category'
                },
                {
                    data: 'stock'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        var itemId = row.id_item;
                        return '<div class="actions">' +
                            '<a class="btn btn-danger btn-small material-icons" href="model.php?halaman=hapus_item&id=' +
                            itemId + '">delete</a>' +
                            '<a class="btn btn-warning btn-small material-icons" style="margin-left : 10px" href="model.php?halaman=hapus_item&id=' +
                            itemId + '">edit</a>' +
                            '</div>';
                    }
                }
            ]
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var openModalBtn = document.getElementById('openModalBtn');
        openModalBtn.addEventListener('click', function() {
            openModal('addCategoryModal');
        });

        window.addEventListener('click', function(event) {
            var modal = document.querySelector('.modal');
            if (event.target === modal) {
                closeModal(modal.getAttribute('id'));
            }
        });
    });

    // jQuery script for the select box with search option
    $(document).ready(function () {
        // Fetch JSON data from the provided URL
        $.getJSON("model.php?halaman=category", function (data) {
            // Iterate through the JSON data and append options to the select box
            $.each(data, function (index, item) {
                $("#mySelect").append("<option value='" + item.id_category + "'>" + item.nama_category + "</option>");
            });

            // Initialize select2
            $("#mySelect").select2({
                // Add additional options as needed
                placeholder: "Select an item",
                allowClear: true,
                width: "resolve",
            });

            // Handle change event of the select box
            $("#mySelect").change(function () {
                // Set the value of the hidden input field (#id) based on the selected item
                var selectedCategoryId = $(this).val();
                
                // Find the corresponding category in the data array
                var selectedCategory = data.find(category => category.id_category == selectedCategoryId);
                
                // Check if the category is found
                if (selectedCategory) {
                    $("#id").val(selectedCategory.category);
                }
            });
        });
    });
    </script>

</body>

</html>