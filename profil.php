<?php
session_start();

if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$kullanici = $_SESSION['kullanici'];

$mesaj_sayisi = count($_SESSION['mesajlar'] ?? []);
$simdi        = date('d.m.Y H:i');
$izlenen_film = rand(5, 47);
$favori_tur   = "Bilim Kurgu";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - Profilim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="ana-icerik">
        <div class="profil-kap">

            <div class="profil-ust">
                <div class="profil-avatar">
                    <?php echo strtoupper(substr($kullanici, 0, 1)); ?>
                </div>
                <div class="profil-info">
                    <h1><?php echo htmlspecialchars($kullanici); ?></h1>
                    <p class="profil-rozet">Film Tutkunu</p>
                    <p class="profil-zaman">Şu an: <?php echo $simdi; ?></p>
                </div>
            </div>

            <div class="istatistik-grid">
                <div class="istatistik-kart">
                    <div class="ist-sayi"><?php echo $izlenen_film; ?></div>
                    <div class="ist-etiket">İzlenen Film</div>
                </div>
                <div class="istatistik-kart">
                    <div class="ist-sayi"><?php echo $mesaj_sayisi; ?></div>
                    <div class="ist-etiket">Mesaj Gönderildi</div>
                </div>
                <div class="istatistik-kart">
                    <div class="ist-sayi">&#11088;</div>
                    <div class="ist-etiket">Favori: <?php echo $favori_tur; ?></div>
                </div>
            </div>

            <div class="profil-bolum">
                <h2>Son Mesajlarım</h2>
                <?php
                $mesajlar     = $_SESSION['mesajlar'] ?? [];
                $son_mesajlar = array_slice($mesajlar, 0, 3);
                ?>

                <?php if (empty($son_mesajlar)): ?>
                    <p class="bos-metin">Henüz mesaj göndermediniz.</p>
                <?php else: ?>
                    <?php foreach ($son_mesajlar as $m): ?>
                        <div class="mini-mesaj">
                            <span class="mesaj-film-tag"><?php echo htmlspecialchars($m['film']); ?></span>
                            <p>
                                <?php echo htmlspecialchars(mb_substr($m['mesaj'], 0, 80)); ?>
                                <?php echo mb_strlen($m['mesaj']) > 80 ? '...' : ''; ?>
                            </p>
                            <small><?php echo $m['tarih']; ?></small>
                        </div>
                    <?php endforeach; ?>
                    <a href="mesajlar.php" class="btn-kucuk">Tüm Mesajları Gör</a>
                <?php endif; ?>
            </div>

            <div class="profil-cikis">
                <a href="cikis.php" class="btn-cikis" style="display:inline-block; text-align:center; padding:0.75rem 2rem;">
                    Çıkış Yap
                </a>
            </div>

        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
