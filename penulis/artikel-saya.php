<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'penulis') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi/koneksi.php';

$id_penulis = $_SESSION['user']['id'];
$data = mysqli_query($conn, "
    SELECT a.*, c.name as category 
    FROM article a 
    JOIN article_author aa ON a.id = aa.article_id 
    JOIN article_category ac ON a.id = ac.article_id 
    JOIN category c ON ac.category_id = c.id
    WHERE aa.author_id = $id_penulis
    ORDER BY a.date DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Artikel Saya</title>
    <link rel="stylesheet" href="../admin/admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Artikel Saya</h2>
        <a href="tambah-artikel.php" class="btn-primary">+ Tambah Artikel</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td style="width:120px;">
                        <?php if (!empty($row['picture'])): ?>
                            <img src="../uploads/<?= $row['picture'] ?>" alt="thumb" style="width:100px; height:auto; border-radius:4px;">
                        <?php else: ?>
                            <em>Tidak ada gambar</em>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td>
                        <a href="edit-artikel.php?id=<?= $row['id'] ?>" class="action-btn btn-edit">Edit</a>
                        <a href="hapus-artikel.php?id=<?= $row['id'] ?>" class="action-btn btn-delete" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
