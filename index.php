<?php
include 'koneksi/koneksi.php';

$sql = "SELECT 
            article.id, 
            article.title, 
            article.date, 
            article.picture, 
            article.content, 
            author.nickname AS author, 
            category.name AS category
        FROM article
        JOIN article_author ON article.id = article_author.article_id
        JOIN author ON article_author.author_id = author.id
        JOIN article_category ON article.id = article_category.article_id
        JOIN category ON article_category.category_id = category.id
        ORDER BY article.date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Sederhana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Blog Artikel</h1>
    <div class="container">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                echo '<div class="card">';
                echo '<a href="detail.php?id=' . $id . '">';
                echo '<img src="images/' . htmlspecialchars($row["picture"]) . '" alt="Gambar Artikel">';
                echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
                echo '</a>';
                echo '<p class="meta">Ditulis oleh <strong>' . htmlspecialchars($row["author"]) . '</strong> pada ' . htmlspecialchars($row["date"]) . ' | Kategori: <em>' . htmlspecialchars($row["category"]) . '</em></p>';
                echo '<p>' . nl2br(htmlspecialchars(substr($row["content"], 0, 200))) . '...</p>';
                echo '<p><a class="read-more" href="detail.php?id=' . $id . '">Baca Selengkapnya →</a></p>';
                echo '</div>';
            }
        } else {
            echo "<p>Tidak ada artikel yang tersedia.</p>";
        }
        ?>
    </div>
</body>
</html>
