<?php
$host = "localhost"; // Host database
$user = "root"; // Username database
$password = ""; // Password database
$database = "inventory"; // Nama database

// Membuat koneksi ke database
$koneksi = new mysqli($host, $user, $password, $database);

// Mengecek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>