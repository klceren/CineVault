<?php
session_start();

if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$kullanici = $_SESSION['kullanici'];

if (!isset($_SESSION['mesajlar'])) {
    $_SESSION['mesajlar'] = [];
}

$basari = "";
$hata   = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mesaj_metni = trim(htmlspecialchars(strip_tags($_POST['mesaj'] ?? '')));
    $film_adi    = trim(htmlspecialchars(strip_tags($_POST['film_adi'] ?? '')));

    if (empty($mesaj_metni)) {
        $hata = "Mesaj boş bırakılamaz!";
    } elseif (mb_strlen($mesaj_metni) < 5) {
        $hata = "Mesaj en az 5 karakter olmalıdır.";
    } elseif (mb_strlen($mesaj_metni) > 500) {
        $hata = "Mesaj en fazla 500 karakter olabilir.";
    } else {
        $yeni_mesaj = [
            'id'        => time(),
            'kullanici' => $kullanici,
            'film'      => empty($film_adi) ? 'Genel' : $film_adi,
            'mesaj'     => $mesaj_metni,
            'tarih'     => date('d.m.Y H:i'),
        ];

        array_unshift($_SESSION['mesajlar'], $yeni_mesaj);

        header("Location: mesajlar.php?gonderildi=1");
        exit;
    }
}

if (isset($_GET['gonderildi']) && $_GET['gonderildi'] == '1') {
    $basari = "Mesajınız başarıyla gönderildi!";
}

$mesajlar     = $_SESSION['mesajlar'];
$mesaj_sayisi = count($mesajlar);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - Mesajlar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="ana-icerik">
        <div class="sayfa-baslik">
            <h1>Film Sohbeti</h1>
            <p>Filmler hakkında düşüncelerini paylaş</p>
        </div>

        <div class="mesaj-form-kap">
            <h2>Yeni Mesaj</h2>

            <?php if (!empty($basari)): ?>
                <div class="basari-kutu"><?php echo $basari; ?></div>
            <?php endif; ?>

            <?php if (!empty($hata)): ?>
                <div class="hata-kutu"><?php echo $hata; ?></div>
            <?php endif; ?>

            <form method="post" action="mesajlar.php">
                <div class="form-grup">
                    <label for="film_adi">Film Adı (opsiyonel)</label>
                    <input type="text" id="film_adi" name="film_adi"
                           placeholder="Hangi film hakkında yazıyorsunuz?" maxlength="100">
                </div>
                <div class="form-grup">
                    <label for="mesaj">Mesajınız *</label>
                    <textarea id="mesaj" name="mesaj" rows="4"
                              placeholder="Film hakkında ne düşünüyorsunuz?"
                              maxlength="500" required></textarea>
                    <small>Maksimum 500 karakter</small>
                </div>
                <button type="submit" class="btn-ana">Gönder</button>
            </form>
        </div>

        <div class="mesajlar-bolum">
            <h2>Tüm Mesajlar
                <span class="rozet"><?php echo $mesaj_sayisi; ?></span>
            </h2>

            <?php if (empty($mesajlar)): ?>
                <div class="bos-sonuc">
                    <p>Henüz mesaj yok. İlk mesajı sen yaz!</p>
                </div>
            <?php else: ?>
                <div class="mesaj-listesi">
                    <?php foreach ($mesajlar as $m): ?>
                        <div class="mesaj-kart">
                            <div class="mesaj-ust">
                                <div class="mesaj-avatar">
                                    <?php echo strtoupper(substr($m['kullanici'], 0, 1)); ?>
                                </div>
                                <div class="mesaj-meta">
                                    <strong><?php echo htmlspecialchars($m['kullanici']); ?></strong>
                                    <?php if ($m['film'] !== 'Genel'): ?>
                                        <span class="film-etiketi"><?php echo htmlspecialchars($m['film']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <span class="mesaj-tarih"><?php echo $m['tarih']; ?></span>
                            </div>
                            <p class="mesaj-metin"><?php echo nl2br(htmlspecialchars($m['mesaj'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
