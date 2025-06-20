<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="content-left">
        <div class="card">
            <h2>Hubungi Kami</h2>
            <p>Jika kamu memiliki pertanyaan, masukan, atau ingin bekerja sama, silakan hubungi kami melalui:</p>
            <ul>
                <li>Email: mahfud0884@gmail.com</li>
                <li>WhatsApp: +62 812-3614-9528</li>
                <li>Instagram: <a href="https://www.instagram.com/mhfdz.11?igsh=NGxlMTI0bnk5cTFm&utm_source=qr">@mhfdz.11</a></li>
            </ul>
            <p>Kami akan dengan senang hati membalas pesanmu!</p>
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
