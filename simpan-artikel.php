<?php
include 'koneksi/koneksi.php';

$title = $_POST['title'];
$date = $_POST['published_date'];
$author_id = $_POST['author_id'];
$category_id = $_POST['category_id'];
$content = $_POST['content'];

$imageName = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
$uploadPath = "images/" . $imageName;
move_uploaded_file($tmp, $uploadPath);

// Simpan ke tabel article
$conn->query(
    "INSERT INTO article (date, title, content, picture)
     VALUES ('$date', '$title', '$content', '$imageName')"
  );

// Ambil ID artikel terakhir
$article_id = $conn->insert_id;

// Simpan ke relasi author dan category
$conn->query("INSERT INTO article_author (article_id, author_id) VALUES ($article_id, $author_id)");
$conn->query("INSERT INTO article_category (article_id, category_id) VALUES ($article_id, $category_id)");

echo "<script>alert('Artikel berhasil disimpan!'); window.location='index.php';</script>";
