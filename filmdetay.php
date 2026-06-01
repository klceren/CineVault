<?php
session_start();

if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit;
}

$film_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$filmler = [
    1 => ['baslik'=>'Inception',       'yil'=>2010, 'puan'=>8.8, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w500/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',  'yonetmen'=>'Christopher Nolan',    'oyuncular'=>'Leonardo DiCaprio, Joseph Gordon-Levitt', 'sure'=>'148 dakika', 'aciklama'=>'Rüyalar içinde rüyalara dalan bir hırsız, suçunu silebilmek için imkânsız bir görevi kabul eder: Bir insanın aklına fikir yerleştirmek.', 'renk'=>'#667eea'],
    2 => ['baslik'=>'The Godfather',   'yil'=>1972, 'puan'=>9.2, 'tur'=>'Suç / Dram',  'poster'=>'https://image.tmdb.org/t/p/w500/eEslKSwcqmiNS6va24Pbxf2UKmJ.jpg',  'yonetmen'=>'Francis Ford Coppola', 'oyuncular'=>'Marlon Brando, Al Pacino, James Caan',    'sure'=>'175 dakika', 'aciklama'=>'Güçlü bir mafya ailesinin çöküşü ve dönüşümü. Sinema tarihinin en büyük eserlerinden biri.',                                          'renk'=>'#f093fb'],
    3 => ['baslik'=>'Interstellar',    'yil'=>2014, 'puan'=>8.6, 'tur'=>'Bilim Kurgu', 'poster'=>'https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg',  'yonetmen'=>'Christopher Nolan',    'oyuncular'=>'Matthew McConaughey, Anne Hathaway',      'sure'=>'169 dakika', 'aciklama'=>'İnsanlığı kurtarmak için uzayın derinliklerine açılan astronotların destansı yolculuğu.',                                              'renk'=>'#4facfe'],
    4 => ['baslik'=>'Parasite',        'yil'=>2019, 'puan'=>8.5, 'tur'=>'Gerilim',     'poster'=>'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg',  'yonetmen'=>'Bong Joon-ho',          'oyuncular'=>'Song Kang-ho, Lee Sun-kyun',               'sure'=>'132 dakika', 'aciklama'=>'Yoksul bir Koreli aile, varlıklı bir ailenin hayatına sızar. Oscar ödüllü sınıf çatışması filmi.',                                       'renk'=>'#43e97b'],
    5 => ['baslik'=>'The Dark Knight', 'yil'=>2008, 'puan'=>9.0, 'tur'=>'Aksiyon',     'poster'=>'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg',  'yonetmen'=>'Christopher Nolan',    'oyuncular'=>'Christian Bale, Heath Ledger',            'sure'=>'152 dakika', 'aciklama'=>'Batman, Gotham şehrini kaosa sürükleyen Joker ile yüzleşir. Heath Ledger\'ın unutulmaz performansıyla efsaneleşen film.',               'renk'=>'#f7971e'],
    11 => ['baslik'=>'Portrait of a Lady on Fire', 'yil'=>2019, 'puan'=>8.0, 'tur'=>'Dram / Romantik', 'poster'=>'https://cdn.posteritati.com/posters/000/000/064/915/portrait-of-a-lady-on-fire-md-web.jpg', 'yonetmen'=>'Céline Sciamma', 'oyuncular'=>'Noémie Merlant, Adèle Haenel', 'sure'=>'122 dakika', 'aciklama'=>'18. yüzyıl Fransa\'sında bir ressam, düğün portresini gizlice yapmak zorunda olduğu genç bir kadına aşık olur. Sessizlik ve bakışlar üzerine kurulu bir aşk hikayesi.', 'renk'=>'#e8c547'],
    6 => ['baslik'=>'Spirited Away',   'yil'=>2001, 'puan'=>8.6, 'tur'=>'Animasyon',   'poster'=>'https://image.tmdb.org/t/p/w500/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg',  'yonetmen'=>'Hayao Miyazaki',        'oyuncular'=>'Daveigh Chase, Suzanne Pleshette',         'sure'=>'125 dakika', 'aciklama'=>'Genç Chihiro, ailesini kurtarmak için ruhlar dünyasında çalışmak zorunda kalır. Studio Ghibli\'nin en sevilen başyapıtı.',             'renk'=>'#fa709a'],
];

if (!array_key_exists($film_id, $filmler)) {
    header("Location: filmler.php");
    exit;
}

$film = $filmler[$film_id];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVault - <?php echo htmlspecialchars($film['baslik']); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        :root { --film-renk: <?php echo $film['renk']; ?>; }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="ana-icerik">
        <a href="filmler.php" class="geri-btn">&larr; Filmlere Dön</a>

        <div class="detay-kart">
            <div class="detay-ust" style="background: linear-gradient(135deg, <?php echo $film['renk']; ?>22, transparent)">
                <div class="detay-poster">
                    <img src="<?php echo $film['poster']; ?>"
                         alt="<?php echo htmlspecialchars($film['baslik']); ?>">
                </div>
                <div class="detay-bilgi">
                    <span class="film-tur"><?php echo htmlspecialchars($film['tur']); ?></span>
                    <h1><?php echo htmlspecialchars($film['baslik']); ?></h1>
                    <div class="detay-meta">
                        <span>&#128197; <?php echo $film['yil']; ?></span>
                        <span>&#9201; <?php echo $film['sure']; ?></span>
                        <span class="puan-badge">&#11088; <?php echo $film['puan']; ?> / 10</span>
                    </div>
                </div>
            </div>

            <div class="detay-icerik">
                <div class="detay-satir">
                    <strong>Yönetmen</strong>
                    <span><?php echo htmlspecialchars($film['yonetmen']); ?></span>
                </div>
                <div class="detay-satir">
                    <strong>Oyuncular</strong>
                    <span><?php echo htmlspecialchars($film['oyuncular']); ?></span>
                </div>
                <div class="detay-aciklama">
                    <strong>Özet</strong>
                    <p><?php echo htmlspecialchars($film['aciklama']); ?></p>
                </div>
            </div>

            <div class="detay-aksiyon">
                <a href="mesajlar.php" class="btn-ana">Bu Film Hakkında Konuş</a>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
