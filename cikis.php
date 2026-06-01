<?php
session_start();

if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cikis_onayla'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$kullanici = $_SESSION['kullanici'];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - Çıkış</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">

    <div class="auth-container">
        <div class="film-strip left"></div>
        <div class="film-strip right"></div>

        <div class="auth-box">
            <div class="logo">&#127916; CineVault</div>
            <p class="auth-subtitle">
                Çıkış yapmak istediğine emin misin,
                <strong><?php echo htmlspecialchars($kullanici); ?></strong>?
            </p>

            <form method="post" action="">
                <button type="submit" name="cikis_onayla" class="btn-giris">Evet, Çıkış Yap</button>
            </form>

            <a href="anasayfa.php" class="btn-kucuk" style="display:block; text-align:center; margin-top:1rem;">
                Vazgeç, Geri Dön
            </a>
        </div>
    </div>

</body>
</html>
