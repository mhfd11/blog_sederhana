<?php
session_start();
include 'koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM author WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($cek);

    if ($data) {
        $_SESSION['login'] = true;
        $_SESSION['user'] = [
            'id' => $data['id'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'role' => $data['role']
        ];

        if ($data['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else if ($data['role'] === 'penulis') {
            header("Location: penulis/dashboard.php");
        } else {
            echo "Role tidak dikenali!";
        }
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="admin/admin-style.css">
    <style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f4f6f8;
    }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="form-box" style="max-width: 400px; width: 100%;">
        <h2 style="text-align:center; color:#007BFF;">Login</h2>
        <?php if (isset($error)): ?>
            <p style="color:red; text-align:center;"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>
    </div>
</div>
</body>
</html>
