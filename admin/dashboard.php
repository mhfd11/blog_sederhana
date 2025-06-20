<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../koneksi/koneksi.php';

$jml_artikel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM article"))['total'];
$jml_kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM category"))['total'];
$jml_penulis = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM author"))['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h2>Selamat Datang di Dashboard</h2>
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h3>Artikel</h3>
                <p><?= $jml_artikel ?> Artikel</p>
            </div>
            <div class="dashboard-card">
                <h3>Kategori</h3>
                <p><?= $jml_kategori ?> Kategori</p>
            </div>
            <div class="dashboard-card">
                <h3>Penulis</h3>
                <p><?= $jml_penulis ?> Penulis</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
