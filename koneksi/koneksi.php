<?php
$conn = new mysqli("localhost", "root", "", "dbcms");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
