

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body class="body_index">

    <div class="sidebar">
        <div class="logo_sidebar">
            <h2 class="center">JTI Inventory</h2>
        </div>
        <hr style="margin-top: 10px;">

        <a href="admin"><span class="material-icons">
                login
            </span> Login</a>
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
        <div class="<?php echo isset($_GET['halaman']) && $_GET['halaman'] == 'stock_management' ? 'active' : ''; ?>">
            <a href="index.php?halaman=stock_management"><span class="material-icons">
                    web_stories
                </span> Stock Management</a>
        </div>
    </div>

    <div class="navbar">

        <h3>Home</h3>
    </div>

    <div class="content">
        <div class="card">
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
        }
            ?>
            <h2>Main Content Goes Here</h2>
            <p>This is a sample content for the main section.</p>
        </div>
    </div>

</body>

</html>