<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include '../koneksi/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Penulis</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Daftar Penulis</h2>
        <a href="tambah-penulis.php" class="btn-primary">+ Tambah Penulis</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM author");
                while($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>
                        <td>{$row['nickname']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='edit-penulis.php?id={$row['id']}' class='action-btn btn-edit'>Edit</a>
                            <a href='hapus-penulis.php?id={$row['id']}' class='action-btn btn-delete' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
