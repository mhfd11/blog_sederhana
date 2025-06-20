<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'penulis') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

$id_penulis = $_SESSION['user']['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM author WHERE id = $id_penulis"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE author SET nickname = '$nickname', email = '$email'";
    if (!empty($password)) {
        $query .= ", password = '$password'";
    }
    $query .= " WHERE id = $id_penulis";

    mysqli_query($conn, $query);

    $_SESSION['user']['nickname'] = $nickname;
    $_SESSION['user']['email'] = $email;

    header("Location: profil.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Profil</title>
    <link rel="stylesheet" href="../admin/admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Kelola Profil</h2>
        <div class="form-box">
            <form method="POST">
                <label>Nama</label>
                <input type="text" name="nickname" value="<?= $data['nickname'] ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?= $data['email'] ?>" required>

                <label>Password Baru (biarkan kosong jika tidak diubah)</label>
                <input type="text" name="password" placeholder="Password baru">

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
