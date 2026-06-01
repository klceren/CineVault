<?php
session_start();

if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$secili_tur = isset($_GET['tur']) ? htmlspecialchars($_GET['tur']) : '';

$filmler = [
    ['id'=>1,  'baslik'=>'Inception',        'yil'=>2010, 'puan'=>8.8, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w300/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',  'yonetmen'=>'Christopher Nolan'],
    ['id'=>2,  'baslik'=>'The Godfather',    'yil'=>1972, 'puan'=>9.2, 'tur'=>'Dram',        'poster'=>'https://image.tmdb.org/t/p/w300/eEslKSwcqmiNS6va24Pbxf2UKmJ.jpg',  'yonetmen'=>'Francis Ford Coppola'],
    ['id'=>3,  'baslik'=>'Interstellar',     'yil'=>2014, 'puan'=>8.6, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w300/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg',  'yonetmen'=>'Christopher Nolan'],
    ['id'=>4,  'baslik'=>'Parasite',         'yil'=>2019, 'puan'=>8.5, 'tur'=>'Gerilim',     'poster'=>'https://image.tmdb.org/t/p/w300/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg',  'yonetmen'=>'Bong Joon-ho'],
    ['id'=>5,  'baslik'=>'The Dark Knight',  'yil'=>2008, 'puan'=>9.0, 'tur'=>'Aksiyon',     'poster'=>'https://image.tmdb.org/t/p/w300/qJ2tW6WMUDux911r6m7haRef0WH.jpg',  'yonetmen'=>'Christopher Nolan'],
    ['id'=>6,  'baslik'=>'Spirited Away',    'yil'=>2001, 'puan'=>8.6, 'tur'=>'Animasyon',   'poster'=>'https://image.tmdb.org/t/p/w300/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg',  'yonetmen'=>'Hayao Miyazaki'],
    ['id'=>7,  'baslik'=>'Pulp Fiction',     'yil'=>1994, 'puan'=>8.9, 'tur'=>'Suç',         'poster'=>'https://image.tmdb.org/t/p/w300/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg',  'yonetmen'=>'Quentin Tarantino'],
    ['id'=>8,  'baslik'=>"Schindler's List", 'yil'=>1993, 'puan'=>9.0, 'tur'=>'Dram',        'poster'=>'https://image.tmdb.org/t/p/w300/sF1U4EUQS8YHUYjNl3pMGNIQyr0.jpg',  'yonetmen'=>'Steven Spielberg'],
    ['id'=>9,  'baslik'=>'The Matrix',       'yil'=>1999, 'puan'=>8.7, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w300/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg',  'yonetmen'=>'Wachowski Sisters'],
    ['id'=>10, 'baslik'=>'Get Out',          'yil'=>2017, 'puan'=>7.7, 'tur'=>'Gerilim',     'poster'=>'https://image.tmdb.org/t/p/w300/tFXcEccSQMf3lfhfXKSU9iRBpa3.jpg',  'yonetmen'=>'Jordan Peele'],
    ['id'=>11, 'baslik'=>'Portrait of a Lady on Fire', 'yil'=>2019, 'puan'=>8.0, 'tur'=>'Dram', 'poster'=>'https://cdn.posteritati.com/posters/000/000/064/915/portrait-of-a-lady-on-fire-md-web.jpg', 'yonetmen'=>'Céline Sciamma'],
    ['id'=>12, 'baslik'=>'Mad Max Fury Road','yil'=>2015, 'puan'=>8.1, 'tur'=>'Aksiyon',     'poster'=>'https://image.tmdb.org/t/p/w300/8tZYtuWezp8JbcsvHYO0O46tFbo.jpg',  'yonetmen'=>'George Miller'],
];

if (!empty($secili_tur)) {
    $filmler = array_filter($filmler, function($film) use ($secili_tur) {
        return $film['tur'] === $secili_tur;
    });
}

$turler = ['Bilim Kurgu', 'Dram', 'Gerilim', 'Aksiyon', 'Animasyon', 'Suç'];
$film_sayisi = count($filmler);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - Filmler</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="ana-icerik">
        <div class="sayfa-baslik">
            <h1>&#127916; Film Kütüphanesi</h1>
            <p><?php echo $film_sayisi; ?> film listeleniyor</p>
        </div>

        <div class="filtre-form">
            <a href="filmler.php" class="filtre-btn <?php echo empty($secili_tur) ? 'aktif' : ''; ?>">Tümü</a>
            <?php foreach ($turler as $tur): ?>
                <a href="filmler.php?tur=<?php echo urlencode($tur); ?>"
                   class="filtre-btn <?php echo ($secili_tur === $tur) ? 'aktif' : ''; ?>">
                    <?php echo $tur; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="film-grid">
            <?php foreach ($filmler as $film): ?>
                <div class="film-kart">
                    <div class="film-poster">
                        <img src="<?php echo $film['poster']; ?>"
                             alt="<?php echo htmlspecialchars($film['baslik']); ?>"
                             loading="lazy">
                    </div>
                    <div class="film-bilgi">
                        <h3><?php echo htmlspecialchars($film['baslik']); ?></h3>
                        <span class="film-tur"><?php echo $film['tur']; ?></span>
                        <p class="film-yonetmen">&#127909; <?php echo htmlspecialchars($film['yonetmen']); ?></p>
                        <div class="film-alt">
                            <span class="film-yil"><?php echo $film['yil']; ?></span>
                            <span class="film-puan">&#11088; <?php echo $film['puan']; ?></span>
                        </div>
                    </div>
                    <a href="filmdetay.php?id=<?php echo $film['id']; ?>" class="kart-link">Detay</a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($filmler)): ?>
            <div class="bos-sonuc">
                <p>Bu türde film bulunamadı.</p>
                <a href="filmler.php">Tüm filmlere dön</a>
            </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
