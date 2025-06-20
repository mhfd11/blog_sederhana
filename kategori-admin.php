<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include 'koneksi/koneksi.php';

// Handle tambah kategori
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    mysqli_query($conn, "INSERT INTO category (name, description) VALUES ('$name', '$description')");
    header("Location: kategori.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
    <h2>Tambah Kategori</h2>
    <form method="POST">
        <label>Nama Kategori</label>
        <input type="text" name="name" required>
        <label>Deskripsi</label>
        <textarea name="description" rows="3"></textarea>
        <button type="submit">Simpan</button>
    </form>
</div>

<h2 style="text-align:center; margin-top:40px;">Daftar Kategori</h2>
<div class="table-wrapper">
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
                        <a href='hapus-kategori.php?id={$row['id']}' class='action-btn btn-delete' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
