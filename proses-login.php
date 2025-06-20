<?php
session_start();
include 'koneksi/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM author WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['login'] = true;
    $_SESSION['email'] = $email;
    header("Location: dashboard.php");
} else {
    echo "Login gagal. <a href='login.php'>Coba lagi</a>";
}
?>