<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'penulis') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penulis</title>
    <link rel="stylesheet" href="../admin/admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Selamat Datang, <?= $_SESSION['user']['nickname'] ?></h2>
        <p>Gunakan menu di samping untuk mengelola artikel atau profil Anda.</p>

        <div class="dashboard-cards" style="margin-top:30px;">
            <div class="dashboard-card">
                <h3>Artikel Anda</h3>
                <p>
                    <?php
                    include '../koneksi/koneksi.php';
                    $penulis_id = $_SESSION['user']['id'];
                    $jumlah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM article_author WHERE author_id = $penulis_id"))['total'];
                    echo $jumlah . " Artikel";
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
