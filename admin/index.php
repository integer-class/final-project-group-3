<?php
session_start();
include '../config.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body class="body_index">

    <div class="sidebar">
        <div class="logo_sidebar">
            <h2 class="center">JTI Inventory</h2>
        </div>
        <hr style="margin-top: 10px;">

        <a href="logout.php"><span class="material-icons">
                logout
            </span> logout</a>
        <hr>
        <div class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'items' ? 'active' : ''; ?>">
            <a href="index.php?halaman=items"><span class="material-icons">
                    handyman
                </span> Items</a>
        </div>
        <hr>
        <div class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'category' ? 'active' : ''; ?>">
            <a href="index.php?halaman=category"
                class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'category' ? 'active' : ''; ?>"><span
                    class="material-icons">
                    category
                </span> Category</a>
            <hr>
        </div>
        <div class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'item_logs' ? 'active' : ''; ?>">
            <a href="index.php?halaman=item_logs"> <span class="material-icons">
                    manage_history
                </span>Item Logs</a>
        </div>
        <hr>

        <div class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'history' ? 'active' : ''; ?>">
            <a href="index.php?halaman=history"><span class="material-icons">
                    history
                </span> History</a>
        </div>
        <hr>
        <div class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'stock_management' ? 'active' : ''; ?>">
            <a href="index.php?halaman=stock_management"><span class="material-icons">
                    web_stories
                </span> Stock Management</a>
        </div>

  

       
        <hr>

        <div class="<?php echo isset($_GET['halaman']) && ($_GET['halaman'] == 'peminjaman' || $_GET['halaman'] == 'tambah_peminjam') ? 'active' : ''; ?>">
            <a href="index.php?halaman=peminjaman"><span class="material-icons">
            real_estate_agent
                </span> Peminjaman</a>
        </div>
    </div>

    <div class="navbar">

        <h3>Home</h3>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <?php if(isset($_GET['halaman'])){
            if($_GET['halaman']=="items"){
                include 'items.php';
            }
            elseif($_GET['halaman']=="category"){
                include 'category.php';
            }
            elseif($_GET['halaman']=="item_logs"){
                include 'item_logs.php';
            }
            elseif($_GET['halaman']=="stock_management"){
                include 'stock_management.php';
            }
            elseif($_GET['halaman']=="history"){
                include 'history.php';
            }
            elseif($_GET['halaman']=="peminjaman"){
                include 'peminjaman.php';
            }
            elseif($_GET['halaman']=="tambah_peminjam"){
                include 'tambah_peminjam.php';
            }
            
        }
            ?>

            </div>


        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var openModalBtn = document.getElementById('openModalBtn');
    var modal = document.getElementById('myModal');
    var closeModalBtn = document.getElementById('closeModalBtn');

    openModalBtn.addEventListener('click', function () {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
    </script>

</html>