<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'penulis') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

$id = $_GET['id'];
$id_penulis = $_SESSION['user']['id'];

$cek = mysqli_query($conn, "
    SELECT a.id FROM article a 
    JOIN article_author aa ON a.id = aa.article_id 
    WHERE a.id = $id AND aa.author_id = $id_penulis
");
if (mysqli_num_rows($cek) === 0) {
    echo "Artikel tidak ditemukan atau bukan milik Anda.";
    exit;
}

mysqli_query($conn, "DELETE FROM article_category WHERE article_id = $id");
mysqli_query($conn, "DELETE FROM article_author WHERE article_id = $id");
mysqli_query($conn, "DELETE FROM article WHERE id = $id");

header("Location: artikel-saya.php");
exit;
?>
