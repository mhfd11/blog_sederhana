<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include '../koneksi/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Daftar Kategori</h2>
        <a href="tambah-kategori.php" class="btn-primary">+ Tambah Kategori</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM category");
                while($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='edit-kategori.php?id={$row['id']}' class='action-btn btn-edit'>Edit</a>
                            <a href='hapus-kategori.php?id={$row['id']}' class='action-btn btn-delete' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
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
