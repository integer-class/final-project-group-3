<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>

    <!-- Sertakan library jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Sertakan library Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
    .card {
        margin-top: 200px;
        margin: 200px
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
    <h2 style="margin-top: -20px;
    margin-bottom: 40px;
    margin-left: 15px;">Loan Form</h2>

    <div class='container'>
        <form method="post" action="model.php?halaman=aksi_pinjam">
            <div class="row">
                <div class="col-md-6">
                    <label for="nama">Loaner id/NIM</label>
                    <input type="text" id="id_peminjam" name="id_peminjam" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="nama">Loaner Name</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                    <input type="hidden" id="id"  name="id_category">
                    
                </div>

            </div>

            <div class="row">
                <div style="margin-top: 30px" class="col-md-5">
                    <label for="tanggal">Quantity </label><br>
                    <input style="width: 350px" type="number" id="jumlah" name="jumlah" class="form-control" required>
                </div>
                <div>
                    <div style="margin-top: 30px; margin-left: 30px" class="col-md-5">
                        <div style="margin-bottom: -1px;">
                            <label for="tanggal">Item Code</label>
                        </div>
                        <select style="" name="id_barang" class="select-box form-control" id="mySelect">
                        </select>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px" class="row">

                <div class="col-md-5">
                    <label for="tanggal">Tanggal Peminjaman:</label><br>
                    <input style="width: 350px;" type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" required>
                </div>
                <div style="margin-left: 30px" class="col-md-5">
                    <label for="tanggal">Tanggal Peminjaman:</label><br>
                    <input style="width: 400px;" type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button style="margin-left:100px; margin-top: -100px" type="submit" class="btn btn-primary">Ajukan
                        Peminjaman</button>
                </div>

            </div>



        </form>
    </div>

    <script>
    $(document).ready(function () {
        // Fetch JSON data from the provided URL
        $.getJSON("model.php?halaman=items", function (data) {
            // Iterate through the JSON data and append options to the select box
            $.each(data, function (index, item) {
                $("#mySelect").append("<option value='" + item.id_item + "'>" + item.nama_item + "</option>");
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
                var selectedItemId = $(this).val();
                
                // Find the corresponding item in the data array
                var selectedItem = data.find(item => item.id_item == selectedItemId);
                
                // Check if the item is found
                if (selectedItem) {
                    $("#id").val(selectedItem.id_category);
                }
            });
        });
    });
</script>


</body>

</html>