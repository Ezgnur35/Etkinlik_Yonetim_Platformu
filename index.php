<?php
require_once "includes/baglanti.php";
require_once "includes/session.php";
require_once "includes/fonksiyonlar.php";

girisKontrol();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Etkinlik Yönetim Platformu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav>
    <h1>Etkinlik Platformu</h1>
    <div>
        <a href="etkinlikler.php">Etkinlikler</a>
        <?php if ($_SESSION["rol"] == "admin"): ?>
            <a href="admin/index.php">Admin Panel</a>
        <?php endif; ?>
        <a href="cikis.php">Çıkış</a>
    </div>
</nav>

<div class="container">
    <h2>Hoş geldin, <?php echo $_SESSION["isim"]; ?>!</h2>
    <p>Etkinliklere göz atmak için aşağıdaki butona tıkla.</p>
    <a href="etkinlikler.php" class="buton">Etkinlikleri Gör</a>
</div>

</body>







</html>