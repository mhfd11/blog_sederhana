<?php
if (!isset($_SESSION)) session_start();
?>
<div class="sidebar">
    <div class="sidebar-top">
        <h2>Penulis</h2>
        <ul>
            <li>
                <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
            </li>
            <li>
                <a href="profil.php" class="<?= basename($_SERVER['PHP_SELF']) === 'profil.php' ? 'active' : '' ?>">Kelola Profil</a>
            </li>
            <li>
                <a href="artikel-saya.php" class="<?= basename($_SERVER['PHP_SELF']) === 'artikel-saya.php' ? 'active' : '' ?>">Artikel Saya</a>
            </li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="sidebar-bottom sidebar-profile">
        <hr>
        <p>👤 <strong><?= $_SESSION['user']['nickname'] ?></strong></p>
        <small><?= $_SESSION['user']['email'] ?></small>
    </div>
</div>
