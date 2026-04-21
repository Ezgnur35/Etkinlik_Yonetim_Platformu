<?php
require_once "includes/baglanti.php";
require_once "includes/session.php";
require_once "includes/fonksiyonlar.php";

 $hata = "";
 $basari = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isim = temizle($_POST["isim"]);
    $email = temizle($_POST["email"]);
    $sifre = $_POST["sifre"];
    $sifre2 = $_POST["sifre2"];

    if ($sifre !== $sifre2) {
        $hata = "Şifreler eşleşmiyor!";
    } elseif (strlen($sifre) < 6) {
        $hata = "Şifre en az 6 karakter olmalı!";
    } else {
        $stmt = $baglanti->prepare("SELECT id FROM kullanicilar WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $hata = "Bu email zaten kayıtlı!";
        } else {
            $hash = password_hash($sifre, PASSWORD_BCRYPT);
            $stmt = $baglanti->prepare("INSERT INTO kullanicilar (isim, email, sifre) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $isim, $email, $hash);
            $stmt->execute();
            $basari = "Kayıt başarılı! Giriş yapabilirsiniz.";
        }
    }
}




?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-kutu">
    <h2>Kayıt Ol</h2>
    <?php if ($hata) echo mesajGoster($hata, "error"); ?>
    <?php if ($basari) echo mesajGoster($basari, "success"); ?>
    <form method="POST">
        <input type="text" name="isim" placeholder="Ad Soyad" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="sifre" placeholder="Şifre" required>
        <input type="password" name="sifre2" placeholder="Şifre Tekrar" required>
        <button type="submit">Kayıt Ol</button>
    </form>
    <p>Hesabın var mı? <a href="giris.php">Giriş Yap</a></p>
</div>
</body>






</html>