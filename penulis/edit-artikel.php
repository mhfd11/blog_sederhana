<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'penulis') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

$id_penulis = $_SESSION['user']['id'];
$id = $_GET['id'];

$cek = mysqli_query($conn, "
    SELECT a.*, ac.category_id 
    FROM article a 
    JOIN article_author aa ON a.id = aa.article_id 
    JOIN article_category ac ON a.id = ac.article_id 
    WHERE a.id = $id AND aa.author_id = $id_penulis
");
$artikel = mysqli_fetch_assoc($cek);
if (!$artikel) {
    echo "Artikel tidak ditemukan atau bukan milik Anda.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $category_id = $_POST['category_id'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    if (!empty($_FILES['picture']['name'])) {
        $target_dir = "../uploads/";
        $new_picture = time() . '_' . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir . $new_picture);
        mysqli_query($conn, "UPDATE article SET title='$title', date='$date', content='$content', picture='$new_picture' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE article SET title='$title', date='$date', content='$content' WHERE id=$id");
    }

    mysqli_query($conn, "UPDATE article_category SET category_id=$category_id WHERE article_id=$id");

    header("Location: artikel-saya.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel</title>
    <link rel="stylesheet" href="../admin/admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Edit Artikel</h2>
        <div class="form-box">
            <form method="POST" enctype="multipart/form-data">
                <label>Judul</label>
                <input type="text" name="title" value="<?= $artikel['title'] ?>" required>

                <label>Tanggal</label>
                <input type="date" name="date" value="<?= $artikel['date'] ?>" required>

                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM category");
                    while ($k = mysqli_fetch_assoc($kategori)) {
                        $selected = ($k['id'] == $artikel['category_id']) ? 'selected' : '';
                        echo "<option value='{$k['id']}' $selected>{$k['name']}</option>";
                    }
                    ?>
                </select>

                <label>Gambar (biarkan kosong jika tidak ingin diubah)</label>
                <input type="file" name="picture" accept="image/*">

                <?php if (!empty($artikel['picture'])): ?>
                    <p><img src="../uploads/<?= $artikel['picture'] ?>" width="150"></p>
                <?php endif; ?>

                <label>Konten</label>
                <textarea name="content" rows="8" required><?= $artikel['content'] ?></textarea>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
