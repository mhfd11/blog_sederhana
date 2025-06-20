<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT a.*, aa.author_id, ac.category_id 
    FROM article a
    LEFT JOIN article_author aa ON a.id = aa.article_id
    LEFT JOIN article_category ac ON a.id = ac.article_id
    WHERE a.id = $id
");
$artikel = mysqli_fetch_assoc($query);
if (!$artikel) {
    echo "Artikel tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];

    $picture = $artikel['picture'];
    if (!empty($_FILES['picture']['name'])) {
        $target_dir = "../uploads/";
        $picture = time() . "_" . basename($_FILES["picture"]["name"]);
        $target_file = $target_dir . $picture;
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
    }

    mysqli_query($conn, "UPDATE article SET title='$title', picture='$picture', date='$date', content='$content' WHERE id=$id");
    mysqli_query($conn, "UPDATE article_author SET author_id=$author_id WHERE article_id=$id");
    mysqli_query($conn, "UPDATE article_category SET category_id=$category_id WHERE article_id=$id");

    header("Location: artikel-list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h2>Edit Artikel</h2>
        <div class="form-box">
            <form method="POST" enctype="multipart/form-data">
                <label>Judul Artikel</label>
                <input type="text" name="title" value="<?= $artikel['title'] ?>" required>

                <label>Tanggal</label>
                <input type="date" name="date" value="<?= $artikel['date'] ?>" required>

                <label>Penulis</label>
                <select name="author_id" required>
                    <option value="">-- Pilih Penulis --</option>
                    <?php
                    $penulis = mysqli_query($conn, "SELECT id, nickname FROM author");
                    while ($p = mysqli_fetch_assoc($penulis)) {
                        $selected = ($p['id'] == $artikel['author_id']) ? 'selected' : '';
                        echo "<option value='{$p['id']}' $selected>{$p['nickname']}</option>";
                    }
                    ?>
                </select>

                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT id, name FROM category");
                    while ($k = mysqli_fetch_assoc($kategori)) {
                        $selected = ($k['id'] == $artikel['category_id']) ? 'selected' : '';
                        echo "<option value='{$k['id']}' $selected>{$k['name']}</option>";
                    }
                    ?>
                </select>

                <label>Gambar Artikel</label>
                <input type="file" name="picture" accept="image/*">
                <?php if (!empty($artikel['picture'])): ?>
                    <p><img src="../uploads/<?= $artikel['picture'] ?>" alt="Gambar lama" style="max-width:200px; margin-top:10px;"></p>
                <?php endif; ?>

                <label>Konten</label>
                <textarea name="content" rows="8" required><?= $artikel['content'] ?></textarea>

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
