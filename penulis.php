<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include 'koneksi/koneksi.php';

// Handle tambah penulis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysqli_query($conn, "INSERT INTO author (nickname, email, password) VALUES ('$nickname', '$email', '$password')");
    header("Location: penulis.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Penulis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
    <h2>Tambah Penulis</h2>
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

<h2 style="text-align:center; margin-top:40px;">Daftar Penulis</h2>
<div class="table-wrapper">
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
                        <a href='hapus-penulis.php?id={$row['id']}' class='action-btn btn-delete' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
