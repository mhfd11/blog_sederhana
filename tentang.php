<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tentang Kami</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="content-left">
        <div class="card">
            <h2>Tentang Jalan Santai Blog</h2>
            <p>Selamat datang di <strong>Blog Jalan-Jalan Malang</strong>! Situs ini adalah tempat berbagi cerita, pengalaman, dan informasi menarik tentang wisata di Malang dan sekitarnya. Kami menyajikan artikel-artikel tentang tempat wisata, kuliner, sejarah, dan budaya lokal.</p>
            <p>Tujuan kami adalah memberikan inspirasi dan panduan kepada para pembaca yang ingin menjelajah keindahan Malang dengan cara yang santai dan bermakna.</p>
        </div>
    </div>
    
    <div class="sidebar">
        <form action="search.php" method="GET">
            <input type="text" name="keyword" placeholder="Cari artikel...">
            <button type="submit">Cari</button>
        </form>

        <h3>Kategori</h3>
        <ul>
            <?php
            include 'koneksi/koneksi.php';
            $kat = mysqli_query($conn, "SELECT * FROM category");
            while($k = mysqli_fetch_assoc($kat)) {
                echo "<li><a href='kategori.php?id={$k['id']}'>" . htmlspecialchars($k['name']) . "</a></li>";
            }
            ?>
        </ul>

        <h3>Tentang</h3>
        <p>Blog tempat berbagi cerita dan info seputar wisata menarik di Malang Raya.</p>
    </div>
</div>

<footer>&copy; <?= date('Y') ?> Jalan Santai Blog</footer>
</body>
</html>
