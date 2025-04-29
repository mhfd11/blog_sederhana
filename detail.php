<?php
include 'koneksi/koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID artikel tidak ditemukan.";
    exit;
}

$id = (int)$_GET['id'];
$sql = "SELECT 
          article.title, 
          article.date, 
          article.picture, 
          article.content, 
          author.nickname AS author, 
          category.name     AS category
        FROM article
        JOIN article_author ON article.id = article_author.article_id
        JOIN author         ON article_author.author_id = author.id
        JOIN article_category ON article.id = article_category.article_id
        JOIN category        ON article_category.category_id = category.id
        WHERE article.id = $id
        LIMIT 1";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    echo "Artikel tidak ditemukan.";
    exit;
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($row['title']); ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <img src="images/<?php echo htmlspecialchars($row['picture']); ?>" alt="">
      <h1><?php echo htmlspecialchars($row['title']); ?></h1>
      <p class="meta">
        Ditulis oleh <strong><?php echo htmlspecialchars($row['author']); ?></strong>
        pada <?php echo htmlspecialchars($row['date']); ?>
        | Kategori: <em><?php echo htmlspecialchars($row['category']); ?></em>
      </p>
      <div class="content">
        <?php echo nl2br($row['content']); ?>
      </div>
      <p><a href="index.php">← Kembali ke Daftar Artikel</a></p>
    </div>
  </div>
</body>
</html>
