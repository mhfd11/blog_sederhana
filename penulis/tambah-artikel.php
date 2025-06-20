<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'penulis') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

$id_penulis = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $category_id = $_POST['category_id'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $picture = '';
    if (!empty($_FILES['picture']['name'])) {
        $target_dir = "../uploads/";
        $picture = time() . '_' . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir . $picture);
    }

    mysqli_query($conn, "INSERT INTO article (title, picture, content, date) VALUES ('$title', '$picture', '$content', '$date')");
    $article_id = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO article_author (article_id, author_id) VALUES ($article_id, $id_penulis)");
    mysqli_query($conn, "INSERT INTO article_category (article_id, category_id) VALUES ($article_id, $category_id)");

    header("Location: artikel-saya.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="../admin/admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Tambah Artikel</h2>
        <div class="form-box">
            <form method="POST" enctype="multipart/form-data">
                <label>Judul</label>
                <input type="text" name="title" required>

                <label>Tanggal</label>
                <input type="date" name="date" required>

                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM category");
                    while ($k = mysqli_fetch_assoc($kategori)) {
                        echo "<option value='{$k['id']}'>{$k['name']}</option>";
                    }
                    ?>
                </select>

                <label>Gambar Artikel</label>
                <input type="file" name="picture" accept="image/*">

                <label>Konten</label>
                <textarea name="content" rows="8" required></textarea>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
