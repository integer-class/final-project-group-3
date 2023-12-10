<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with Search and Pagination</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
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
        width: 40%;
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
    </style>
</head>

<body>
    <div id="table-container">
        <button id="openModalBtn" style="margin-bottom: 50px; float:left" class="btn btn-primary">Add Category</button>

        <table style="width: 100%; text-align-last: center;" id="data-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Item Types</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <h2>Add Category</h2>
            <form method="post" action="model.php?halaman=tambah_category">
                <label for="addInputName">Name:</label>
                <input type="text" id="addInputName" name="nama_category" required>
                <label for="addCategory">Category:</label>
                <input type="text" id="addCategory" name="category" required>
                <div style="margin-top: 20px;">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="button" onclick="closeModal('addCategoryModal')">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="modal">
        <div class="modal-content">
            <h2>Edit Category</h2>
            <form method="post" action="model.php?halaman=edit_category">
                <label for="editInputName">Name:</label>
                <input type="text" id="editInputName" name="nama_category" required>
                <label for="editCategory">Category:</label>
                <input type="text" id="editCategory" name="category" required>
                <div style="margin-top: 20px;">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="button"
                        onclick="closeModal('editCategoryModal')">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        // Menggunakan DataTables
        $('#data-table').DataTable({
            ajax: {
                url: 'model.php?halaman=category',
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
                    data: 'nama_category'
                },
                {
                    data: 'category'
                },
                {
                    data: 'num_item'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        var itemId = row.id_category;
                        return '<div class="actions">' +
                            '<a class="btn btn-danger btn-small material-icons" href="model.php?halaman=hapus_category&id=' +
                            itemId + '">delete</a>' +
                            '<a class="btn btn-warning btn-small material-icons" style="margin-left : 10px" href="#" data-id="' +
                            itemId + '" onclick="openEditModal(' + itemId + ')" >edit</a>' +
                            '</div>';
                    }
                }
            ]
        });
    });

    function openEditModal(categoryId) {
        console.log('Opening edit modal for category ID:', categoryId);
        $.ajax({
            url: 'model.php?halaman=get_category&id=' + categoryId,
            method: 'GET',
            success: function(response) {
                document.getElementById('editInputName').value = response.nama_category;
                document.getElementById('editCategory').value = response.category;

                console.log('response:', response);
            },

            error: function(error) {
                console.error('Error fetching category data:', error);
            }
        });




        openModal('editCategoryModal');
    }

    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = 'block';
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        var openModalBtn = document.getElementById('openModalBtn');
        openModalBtn.addEventListener('click', function() {
            openModal('addCategoryModal');
        });

        var closeButtons = document.querySelectorAll('.btn-danger');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                closeModal(button.getAttribute('data-modal'));
            });
        });

        window.addEventListener('click', function(event) {
            var modal = document.querySelector('.modal');
            if (event.target === modal) {
                closeModal(modal.getAttribute('id'));
            }
        });
    });
    </script>
</body>

</html>