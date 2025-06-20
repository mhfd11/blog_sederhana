<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $date = $_POST['date'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];

    $picture_name = '';
    if (!empty($_FILES['picture']['name'])) {
        $target_dir = "../uploads/";
        $picture_name = time() . "_" . basename($_FILES["picture"]["name"]);
        $target_file = $target_dir . $picture_name;
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
    }

    mysqli_query($conn, "INSERT INTO article (title, picture, content, date) VALUES ('$title', '$picture_name', '$content', '$date')");
    $article_id = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO article_author (article_id, author_id) VALUES ($article_id, $author_id)");
    mysqli_query($conn, "INSERT INTO article_category (article_id, category_id) VALUES ($article_id, $category_id)");

    header("Location: artikel-list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h2>Tambah Artikel Baru</h2>
        <div class="form-box">
            <form method="POST" enctype="multipart/form-data">
                <label>Judul Artikel</label>
                <input type="text" name="title" required>

                <label>Tanggal</label>
                <input type="date" name="date" required>

                <label>Penulis</label>
                <select name="author_id" required>
                    <option value="">-- Pilih Penulis --</option>
                    <?php
                    $penulis = mysqli_query($conn, "SELECT id, nickname FROM author");
                    while ($p = mysqli_fetch_assoc($penulis)) {
                        echo "<option value='{$p['id']}'>{$p['nickname']}</option>";
                    }
                    ?>
                </select>

                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT id, name FROM category");
                    while ($k = mysqli_fetch_assoc($kategori)) {
                        echo "<option value='{$k['id']}'>{$k['name']}</option>";
                    }
                    ?>
                </select>

                <label>Gambar Artikel</label>
                <input type="file" name="picture" accept="image/*">

                <label>Konten</label>
                <textarea name="content" rows="8" required></textarea>

                <button type="submit">Simpan Artikel</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
