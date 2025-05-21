<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "toko_onlineku";

// Membuat koneksi
$con = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset untuk menghindari masalah encoding
mysqli_set_charset($con, "utf8mb4");

// Jika ingin memverifikasi koneksi berhasil (opsional)
  //echo "Koneksi berhasil! Versi MySQL Server: " . mysqli_get_server_info($con);
?>