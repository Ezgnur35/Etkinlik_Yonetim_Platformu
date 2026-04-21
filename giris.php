<?php
require_once "includes/baglanti.php";
require_once "includes/session.php";
require_once "includes/fonksiyonlar.php";

$hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = temizle($_POST["email"]);
    $sifre = $_POST["sifre"];

     $stmt = $baglanti->prepare("SELECT * FROM kullanicilar WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $sonuc = $stmt->get_result();
    $kullanici = $sonuc->fetch_assoc();

    if ($kullanici && password_verify($sifre, $kullanici["sifre"])) {
        $_SESSION["kullanici_id"] = $kullanici["id"];
        $_SESSION["isim"] = $kullanici["isim"];
        $_SESSION["rol"] = $kullanici["rol"];
         yonlendir("index.php");
    } else {
         $hata = "Email veya şifre hatalı!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">

    <title>Giriş Yap</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-kutu">
    <h2>Giriş Yap</h2>
    <?php if ($hata) echo mesajGoster($hata, "error"); ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="sifre" placeholder="Şifre" required>
        <button type="submit">Giriş Yap</button>
    </form>
    <p>Hesabın yok mu? <a href="kayit.php">Kayıt Ol</a></p>
</div>

</body>





</html>