<?php
session_start();

if (isset($_SESSION['kullanici'])) {
    header("Location: anasayfa.php");
    exit;
}

$hata = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kullanici_adi = trim(htmlspecialchars($_POST['kullanici_adi']));
    $sifre         = trim($_POST['sifre']);

    if ($kullanici_adi === 'admin' && $sifre === '1234') {
        $_SESSION['kullanici'] = $kullanici_adi;
        header("Location: anasayfa.php");
        exit;
    } else {
        $hata = "Kullanıcı adı veya şifre yanlış!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - Giriş</title>
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
            <p class="auth-subtitle">Film dünyasına hoş geldiniz</p>

            <?php if (!empty($hata)): ?>
                <div class="hata-kutu"><?php echo $hata; ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="form-grup">
                    <label for="kullanici_adi">Kullanıcı Adı</label>
                    <input type="text" id="kullanici_adi" name="kullanici_adi"
                           placeholder="admin" required autocomplete="username">
                </div>
                <div class="form-grup">
                    <label for="sifre">Şifre</label>
                    <input type="password" id="sifre" name="sifre"
                           placeholder="1234" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn-giris">Giriş Yap</button>
            </form>

            <p class="auth-hint">Demo: <strong>admin</strong> / <strong>1234</strong></p>
        </div>
    </div>

</body>
</html>
