<?php
// ===== simpan-penulis.php =====
include 'koneksi/koneksi.php';
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$password = $_POST['password'];

mysqli_query($conn, "INSERT INTO author (nickname, email, password) VALUES ('$nickname', '$email', '$password')");
header("Location: penulis.php");
?>