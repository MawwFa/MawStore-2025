<?php
session_start();

// Jika belum login, redirect ke login.php
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

echo "Selamat datang, " . $_SESSION['username'];
echo "<br><a href='logout.php'>Logout</a>";

// Konten halaman utama Anda di sini
?>