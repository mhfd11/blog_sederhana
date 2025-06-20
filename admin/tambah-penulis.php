<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysqli_query($conn, "INSERT INTO author (nickname, email, password) VALUES ('$nickname', '$email', '$password')");
    header("Location: penulis-list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Penulis</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Tambah Penulis Baru</h2>
        <div class="form-box">
            <form method="POST">
                <label>Nama Penulis</label>
                <input type="text" name="nickname" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="text" name="password" required>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
