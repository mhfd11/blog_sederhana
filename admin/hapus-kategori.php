<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include '../koneksi/koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM category WHERE id = $id");
header("Location: kategori-list.php");
?>
