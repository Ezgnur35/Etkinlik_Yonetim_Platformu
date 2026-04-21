<?php
require_once "includes/baglanti.php";
require_once "includes/session.php";
require_once "includes/fonksiyonlar.php";


girisKontrol();

$etkinlikler = etkinlikleriGetir($baglanti);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Etkinlikler</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<nav>
    <h1>Etkinlik Platformu</h1>
    <div>
        <a href="index.php">Ana Sayfa</a>
        <?php if ($_SESSION["rol"] == "admin"): ?>
            <a href="admin/index.php">Admin Panel</a>
        <?php endif; ?>

        <a href="cikis.php">Çıkış</a>
    </div>
</nav>

<div class="container">
    <h2>Tüm Etkinlikler</h2>
    <div class="etkinlik-listesi">
        <?php while ($etkinlik = mysqli_fetch_assoc($etkinlikler)): ?>
        <div class="etkinlik-kart">
            <h3><?php echo $etkinlik["baslik"]; ?></h3>
            <p> <?php echo date("d.m.Y H:i", strtotime($etkinlik["tarih"])); ?></p>
            <p> <?php echo $etkinlik["konum"]; ?></p>
            <p><?php echo $etkinlik["organizator"]; ?></p>
            <a href="etkinlik_detay.php?id=<?php echo $etkinlik["id"]; ?>" class="buton">Detay</a>
        </div>
        <?php endwhile; ?>
    </div>
</div>


</body>



</html>