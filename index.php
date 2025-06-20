<?php
include 'koneksi/koneksi.php';
$result = mysqli_query($conn, "
    SELECT a.*, c.name AS category 
    FROM article a 
    JOIN article_category ac ON a.id = ac.article_id 
    JOIN category c ON ac.category_id = c.id 
    ORDER BY a.date DESC 
    LIMIT 7
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Beranda - Blog Wisata</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="hero">
    <h1>Selamat Datang di Blog Kami!</h1>
    <p>Blog Catatan Wisata dan Jalan-jalan</p>
</div>

<div class="container">
    <div class="content-left">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
                <?php if (!empty($row['picture']) && file_exists("uploads/" . $row['picture'])): ?>
                    <img src="uploads/<?= $row['picture'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                <?php endif; ?>

                <p style="color:#666; font-size:13px; margin-top:10px;">
                    <?= date("l, d F Y | H:i", strtotime($row['date'])) ?>
                </p>

                <h2><?= htmlspecialchars($row['title']) ?></h2>

                <p><?= substr(strip_tags($row['content']), 0, 200) ?>...</p>

                <a href="detail.php?id=<?= $row['id'] ?>" class="read-more">Selengkapnya →</a>
            </div>
        <?php } ?>
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
