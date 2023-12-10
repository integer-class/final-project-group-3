<?php
include '../config.php';
session_start();
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management System</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <script>
    function showAlert(message) {
        var alertDiv = document.getElementById("loginAlert");
        alertDiv.style.display = "block";
        alertDiv.innerHTML = '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' + message;
    }
  </script>
  
</head>

<body class="loginpage">
  <div class="navbarlogin">
    <div class="logojti">Jti Inventory</div>
  </div>

  <div style="margin-top : -50px" class="loginMenu child center">
    <div class="form">
      <form class="registerForm" method="post">
      <div id="loginAlert" class="alert"></div>
        <div class="logoLogin"></div>
        <div style="margin-top: -15px"  class="center">
          <h4>Login</h4><br>
        </div>
        <p style="margin-top: -10px;" class="center">Please Enter Your Username And Password !</p>

        <label style="margin-top: 30px">Username</label>
        <input type="text" name="username" placeholder="username" />
        <label>Password</label>
        <input type="password" name="password" placeholder="password" />
        <button class="btn-primary" type="submit" name="login">Login</button>
       
      </form>
    </div>
  </div>

  <?php
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ambil_data = $koneksi->query("SELECT id_user,username FROM tb_user WHERE username='$username' AND password='$password'");
    $data_user = $ambil_data->fetch_assoc();
    $cek = $ambil_data->num_rows;

    if ($cek == 1) {
      $_SESSION['id_user'] = $data_user['id_user'];
      $_SESSION['username'] = $data_user['username'];
      
      echo "<script>location='index.php';</script>";


    } else {
      echo "<script>showAlert('Username/password salah');</script>";
    }
  }
  ?>

</body>


</html>
