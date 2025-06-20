<?php
if (!isset($_SESSION)) session_start();
?>
<div class="sidebar">
    <div class="sidebar-top">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="penulis-list.php" class="<?= basename($_SERVER['PHP_SELF']) === 'penulis-list.php' ? 'active' : '' ?>">Kelola Penulis</a></li>
            <li><a href="kategori-list.php" class="<?= basename($_SERVER['PHP_SELF']) === 'kategori-list.php' ? 'active' : '' ?>">Kelola Kategori</a></li>
            <li><a href="artikel-list.php" class="<?= basename($_SERVER['PHP_SELF']) === 'artikel-list.php' ? 'active' : '' ?>">Kelola Artikel</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="sidebar-bottom sidebar-profile">
        <hr>
        <p>👤 <strong><?= $_SESSION['user']['nickname'] ?></strong></p>
        <small><?= $_SESSION['user']['email'] ?></small>
    </div>
</div>
