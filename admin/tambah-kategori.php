<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    mysqli_query($conn, "INSERT INTO category (name, description) VALUES ('$name', '$description')");
    header("Location: kategori-list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h2>Tambah Kategori Baru</h2>
        <div class="form-box">
            <form method="POST">
                <label>Nama Kategori</label>
                <input type="text" name="name" required>

                <label>Deskripsi</label>
                <textarea name="description" rows="3"></textarea>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
