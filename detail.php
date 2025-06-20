<?php
include 'koneksi/koneksi.php';
$id = $_GET['id'] ?? 0;

$result = mysqli_query($conn, "
    SELECT a.*, au.nickname, c.name AS category 
    FROM article a 
    JOIN article_author aa ON a.id = aa.article_id 
    JOIN author au ON aa.author_id = au.id 
    JOIN article_category ac ON a.id = ac.article_id 
    JOIN category c ON ac.category_id = c.id 
    WHERE a.id = $id
");
$artikel = mysqli_fetch_assoc($result);
if (!$artikel) {
    echo "<p>Artikel tidak ditemukan.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($artikel['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="content-left">
        <div class="card">
            <p style="color:#666; font-size:13px; margin-bottom:10px;">
                <?= date("l, d F Y | H:i", strtotime($artikel['date'])) ?> oleh <?= htmlspecialchars($artikel['nickname']) ?> - Kategori: <?= htmlspecialchars($artikel['category']) ?>
            </p>

            <?php if (!empty($artikel['picture']) && file_exists("uploads/" . $artikel['picture'])): ?>
                <img src="uploads/<?= $artikel['picture'] ?>" alt="<?= htmlspecialchars($artikel['title']) ?>" class="detail-image">
            <?php endif; ?>

            <h2><?= htmlspecialchars($artikel['title']) ?></h2>

            <div class="article-content" style="margin-top: 15px; line-height: 1.6;">
                <?= $artikel['content'] ?>
            </div>

            <a href="index.php" class="read-more" style="background-color: #6c757d; margin-top: 20px;">← Kembali</a>
        </div>

        <h3 style="margin-top: 40px;">Artikel Terkait</h3>
        <ul>
        <?php
        $cat_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category_id FROM article_category WHERE article_id = $id"))['category_id'];
        $related = mysqli_query($conn, "
            SELECT a.id, a.title FROM article a 
            JOIN article_category ac ON a.id = ac.article_id 
            WHERE ac.category_id = $cat_id AND a.id != $id 
            ORDER BY a.date DESC LIMIT 3
        ");
        while ($rel = mysqli_fetch_assoc($related)) {
            echo "<li><a href='detail.php?id={$rel['id']}'>" . htmlspecialchars($rel['title']) . "</a></li>";
        }
        ?>
        </ul>
    </div>

    <div class="sidebar">
        <div class="sidebar-section">
        <form action="search.php" method="GET">
            <input type="text" name="keyword" placeholder="Cari artikel...">
            <button type="submit">Cari</button>
        </form>
        </div>
        <div class="sidebar-section">
        <h3>Kategori</h3>
        <ul>
        <?php
        $kat = mysqli_query($conn, "SELECT * FROM category");
        while($k = mysqli_fetch_assoc($kat)) {
            echo "<li><a href='kategori.php?id={$k['id']}'>" . htmlspecialchars($k['name']) . "</a></li>";
        }
        ?>
        </ul>
        </div>
        <div class="sidebar-section">
        <h3>Tentang</h3>
        <p>Blog tempat berbagi cerita dan info seputar wisata menarik di Malang Raya.</p>
        </div>
    </div>
</div>

<footer>&copy; <?= date('Y') ?> Jalan Santai Blog</footer>
</body>
</html>
