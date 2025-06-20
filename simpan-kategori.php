<?php
// ===== simpan-kategori.php =====
include 'koneksi/koneksi.php';
$name = $_POST['name'];
$desc = $_POST['description'];
mysqli_query($conn, "INSERT INTO category (name, description) VALUES ('$name', '$desc')");
header("Location: kategori.php");
?>