<?php
$aktif_sayfa = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <a href="anasayfa.php" class="nav-logo">&#127916; CineVault</a>

    <div class="nav-linkler">
        <a href="anasayfa.php"
           class="nav-link <?php echo ($aktif_sayfa === 'anasayfa.php') ? 'aktif' : ''; ?>">
            Ana Sayfa
        </a>
        <a href="filmler.php"
           class="nav-link <?php echo ($aktif_sayfa === 'filmler.php' || $aktif_sayfa === 'filmdetay.php') ? 'aktif' : ''; ?>">
            Filmler
        </a>
        <a href="mesajlar.php"
           class="nav-link <?php echo ($aktif_sayfa === 'mesajlar.php') ? 'aktif' : ''; ?>">
            Mesajlar
        </a>
        <a href="profil.php"
           class="nav-link <?php echo ($aktif_sayfa === 'profil.php') ? 'aktif' : ''; ?>">
            <?php echo htmlspecialchars($_SESSION['kullanici'] ?? 'Profil'); ?>
        </a>
        <a href="cikis.php"
           class="nav-link <?php echo ($aktif_sayfa === 'cikis.php') ? 'aktif' : ''; ?>">
            Çıkış
        </a>
    </div>
</nav>
