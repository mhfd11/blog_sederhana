<?php
include 'koneksi/koneksi.php';
$keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
$query = "SELECT a.*, c.name as category FROM article a
          JOIN article_category ac ON a.id = ac.article_id
          JOIN category c ON ac.category_id = c.id
          WHERE a.title LIKE '%$keyword%' OR a.content LIKE '%$keyword%'
          ORDER BY a.date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<!-- Hero / Judul -->
<div class="hero">
    <h1>Hasil Pencarian</h1>
    <p>Menampilkan hasil untuk: <strong>"<?= htmlspecialchars($keyword) ?>"</strong></p>
</div>

<div class="container">
    <div class="content-left">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <?php if (!empty($row['picture']) && file_exists("uploads/" . $row['picture'])): ?>
                        <img src="uploads/<?= $row['picture'] ?>" alt="<?= $row['title'] ?>">
                    <?php endif; ?>
                    <p style="color:#666; font-size:13px; margin-top:10px;">
                        <?= date("l, d F Y | H:i", strtotime($row['date'])) ?>
                    </p>
                    <h2><?= htmlspecialchars($row['title']) ?></h2>
                    <p><?= substr(strip_tags($row['content']), 0, 200) . '...' ?></p>
                    <a href="detail.php?id=<?= $row['id'] ?>" class="read-more">Selengkapnya →</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p><em>Tidak ditemukan hasil untuk "<strong><?= htmlspecialchars($keyword) ?></strong>"</em></p>
        <?php endif; ?>
    </div>

    <div class="sidebar">

        <div class="sidebar-section">
            <h3>Pencarian</h3>
            <form action="search.php" method="GET">
                <input type="text" name="keyword" placeholder="Masukkan kata kunci...">
                <button type="submit">Go!</button>
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
            <p>
                Sekedar buah tangan catatan wisata dan jalan-jalan ke tempat wisata seputar Malang Raya.
                Tidak menutup kemungkinan juga akan ke daerah lain.
                Komentar dan saran silahkan ditinggalkan di kontak.
            </p>
        </div>

    </div>
</div>

<footer>&copy; <?= date('Y') ?> Jalan Santai Blog</footer>
</body>
</html>
