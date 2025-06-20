<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../koneksi/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Artikel</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Daftar Artikel</h2>
        <a href="tambah-artikel.php" class="btn-primary">+ Tambah Artikel</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                    SELECT 
                        a.id, a.title, a.date,
                        au.nickname AS author,
                        GROUP_CONCAT(c.name SEPARATOR ', ') AS categories
                    FROM article a
                    JOIN article_author aa ON a.id = aa.article_id
                    JOIN author au ON aa.author_id = au.id
                    JOIN article_category ac ON a.id = ac.article_id
                    JOIN category c ON ac.category_id = c.id
                    GROUP BY a.id
                    ORDER BY a.date DESC
                ";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['author']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['categories']}</td>
                        <td>
                            <a href='edit-artikel.php?id={$row['id']}' class='action-btn btn-edit'>Edit</a>
                            <a href='hapus-artikel.php?id={$row['id']}' class='action-btn btn-delete' onclick=\"return confirm('Yakin hapus artikel ini?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
