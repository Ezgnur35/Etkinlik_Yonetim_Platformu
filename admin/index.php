<?php
require_once "../includes/baglanti.php";
require_once "../includes/session.php";
require_once "../includes/fonksiyonlar.php";

adminKontrol();


$kullanici_sayisi = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as sayi FROM kullanicilar"))["sayi"];
$etkinlik_sayisi = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as sayi FROM etkinlikler"))["sayi"];
$kayit_sayisi = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as sayi FROM kayitlar"))["sayi"];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav>
    <h1>Admin Panel</h1>
    <div>
        <a href="../index.php">Siteye Dön</a>
        <a href="etkinlikler.php">Etkinlikler</a>
        <a href="kullanicilar.php">Kullanıcılar</a>
        <a href="../cikis.php">Çıkış</a>
    </div>
</nav>

<div class="container">
    <h2>Genel Bakış</h2>
    
    <div class="istatistik">
        <div class="kart">
            <h3><?php echo $kullanici_sayisi; ?></h3>
            <p>Toplam Kullanıcı</p>
        </div>
        <div class="kart">
            <h3><?php echo $etkinlik_sayisi; ?></h3>
            <p>Toplam Etkinlik</p>
        </div>
        <div class="kart">
            <h3><?php echo $kayit_sayisi; ?></h3>
            <p>Toplam Kayıt</p>
        </div>
    </div>
</div>

</body>





</html>