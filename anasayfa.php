<?php
session_start();

if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$kullanici = $_SESSION['kullanici'];

$onerilen_filmler = [
    ['id'=>1, 'baslik'=>'Inception',       'yil'=>2010, 'puan'=>8.8, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w300/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg'],
    ['id'=>2, 'baslik'=>'The Godfather',  'yil'=>1972, 'puan'=>9.2, 'tur'=>'Dram',        'poster'=>'https://image.tmdb.org/t/p/w300/eEslKSwcqmiNS6va24Pbxf2UKmJ.jpg'],
    ['id'=>3, 'baslik'=>'Interstellar',    'yil'=>2014, 'puan'=>8.6, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w300/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg'],
    ['id'=>4, 'baslik'=>'Parasite',        'yil'=>2019, 'puan'=>8.5, 'tur'=>'Gerilim',     'poster'=>'https://image.tmdb.org/t/p/w300/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg'],
    ['id'=>5, 'baslik'=>'The Dark Knight', 'yil'=>2008, 'puan'=>9.0, 'tur'=>'Aksiyon',     'poster'=>'https://image.tmdb.org/t/p/w300/qJ2tW6WMUDux911r6m7haRef0WH.jpg'],
    ['id'=>6, 'baslik'=>'Spirited Away',   'yil'=>2001, 'puan'=>8.6, 'tur'=>'Animasyon',   'poster'=>'https://image.tmdb.org/t/p/w300/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg'],
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - Ana Sayfa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="ana-icerik">
        <section class="hero">
            <div class="hero-ic">
                <span class="hero-etiket">Hoş geldiniz</span>
                <h1>Merhaba, <span class="vurgu"><?php echo htmlspecialchars($kullanici); ?></span>!</h1>
                <p>Bugün hangi filmi izleyeceksin?</p>
                <a href="filmler.php" class="btn-ana">Filmleri Keşfet</a>
            </div>
        </section>

        <section class="bolum">
            <h2 class="bolum-baslik">Önerilen Filmler</h2>
            <div class="film-grid">
                <?php foreach ($onerilen_filmler as $film): ?>
                    <div class="film-kart">
                        <div class="film-poster">
                            <img src="<?php echo $film['poster']; ?>"
                                 alt="<?php echo htmlspecialchars($film['baslik']); ?>"
                                 loading="lazy">
                        </div>
                        <div class="film-bilgi">
                            <h3><?php echo htmlspecialchars($film['baslik']); ?></h3>
                            <span class="film-tur"><?php echo $film['tur']; ?></span>
                            <div class="film-alt">
                                <span class="film-yil"><?php echo $film['yil']; ?></span>
                                <span class="film-puan">&#11088; <?php echo $film['puan']; ?></span>
                            </div>
                        </div>
                        <a href="filmdetay.php?id=<?php echo $film['id']; ?>" class="kart-link">İncele</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
