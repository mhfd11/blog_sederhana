<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include '../koneksi/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    mysqli_query($conn, "UPDATE category SET name='$name', description='$description' WHERE id=$id");
    header("Location: kategori-list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Edit Kategori</h2>
        <form method="POST" class="form-box" style="max-width:600px; margin-top: 20px;">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="<?= $data['name'] ?>" required>
            <label>Deskripsi</label>
            <textarea name="description" rows="3"><?= $data['description'] ?></textarea>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
