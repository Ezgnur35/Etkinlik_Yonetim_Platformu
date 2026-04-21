<?php
require_once "includes/baglanti.php";
require_once "includes/session.php";
require_once "includes/fonksiyonlar.php";



girisKontrol();

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
$etkinlik = etkinlikDetay($baglanti, $id);

if (!$etkinlik) {

    yonlendir("etkinlikler.php");
}

$mesaj = "";
$kayitliMi = kayitliMi($baglanti, $_SESSION["kullanici_id"], $id);

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$kayitliMi) {
    $stmt = $baglanti->prepare("INSERT INTO kayitlar (kullanici_id, etkinlik_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $_SESSION["kullanici_id"], $id);
    $stmt->execute();
    $kayitliMi = true;
    $mesaj = "Etkinliğe başarıyla kayıt oldunuz!";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $etkinlik["baslik"]; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<nav>
    <h1>Etkinlik Platformu</h1>

    <div>
        <a href="index.php">Ana Sayfa</a>
        <a href="etkinlikler.php">Etkinlikler</a>
        <a href="cikis.php">Çıkış</a>
    </div>
</nav>

<div class="container">
    <h2><?php echo $etkinlik["baslik"]; ?></h2>
    <?php if ($mesaj) echo mesajGoster($mesaj, "success"); ?>
    <p><?php echo $etkinlik["aciklama"]; ?></p>
    <p><?php echo date("d.m.Y H:i", strtotime($etkinlik["tarih"])); ?></p>
    <p> <?php echo $etkinlik["konum"]; ?></p>
    <p> Kapasite: <?php echo $etkinlik["kapasite"]; ?></p>
    <p> Organizatör: <?php echo $etkinlik["organizator"]; ?></p>

    <?php if ($kayitliMi): ?>
        <p class="basari">Bu etkinliğe kayıtlısınız!</p>
    <?php else: ?>
        <form method="POST">
            <button type="submit" class="buton">Etkinliğe Kayıt Ol</button>
        </form>
    <?php endif; ?>

    <a href="etkinlikler.php">← Geri Dön</a>
</div>

</body>


</html>