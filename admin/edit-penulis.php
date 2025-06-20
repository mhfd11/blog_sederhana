<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include '../koneksi/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM author WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysqli_query($conn, "UPDATE author SET nickname='$nickname', email='$email', password='$password' WHERE id=$id");
    header("Location: penulis-list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Penulis</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Edit Penulis</h2>
        <form method="POST" class="form-box" style="max-width:600px;">
            <label>Nama Penulis</label>
            <input type="text" name="nickname" value="<?= $data['nickname'] ?>" required>
            <label>Email</label>
            <input type="email" name="email" value="<?= $data['email'] ?>" required>
            <label>Password</label>
            <input type="text" name="password" value="<?= $data['password'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
