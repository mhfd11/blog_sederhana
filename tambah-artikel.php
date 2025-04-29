<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Artikel</h1>
    <form action="simpan-artikel.php" method="POST" enctype="multipart/form-data" class="form-container">
        <label>Judul Artikel:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Tanggal Publikasi:</label><br>
        <input type="date" name="published_date" required><br><br>

        <label>Penulis:</label><br>
        <select name="author_id" required>
            <?php
            include 'koneksi/koneksi.php';
            $author = $conn->query("SELECT * FROM author");
            while ($row = $author->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nickname']}</option>";
            }
            ?>
        </select><br><br>

        <label>Kategori:</label><br>
        <select name="category_id" required>
            <?php
            $category = $conn->query("SELECT * FROM category");
            while ($row = $category->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select><br><br>

        <label>Gambar:</label><br>
        <input type="file" name="image" accept="image/*" required><br><br>

        <label>Isi Artikel:</label><br>
        <textarea name="content" rows="5" required></textarea><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
