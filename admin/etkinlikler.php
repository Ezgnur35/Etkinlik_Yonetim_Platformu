<?php
require_once "../includes/baglanti.php";
require_once "../includes/session.php";
require_once "../includes/fonksiyonlar.php";


adminKontrol();

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $baslik = temizle($_POST["baslik"]);
    $aciklama = temizle($_POST["aciklama"]);
    $tarih = $_POST["tarih"];
    $konum = temizle($_POST["konum"]);
    $kapasite = (int)$_POST["kapasite"];

    $stmt = $baglanti->prepare("INSERT INTO etkinlikler (baslik, aciklama, tarih, konum, kapasite, kullanici_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $baslik, $aciklama, $tarih, $konum, $kapasite, $_SESSION["kullanici_id"]);
    $stmt->execute();

    $mesaj = "Etkinlik başarıyla eklendi!";
}

if (isset($_GET["sil"])) {
    $sil_id = (int)$_GET["sil"];
    mysqli_query($baglanti, "DELETE FROM kayitlar WHERE etkinlik_id = $sil_id");
    mysqli_query($baglanti, "DELETE FROM etkinlikler WHERE id = $sil_id");
    yonlendir("admin/etkinlikler.php");
}

$etkinlikler = etkinlikleriGetir($baglanti);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Etkinlik Yönetimi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav>
    <h1>Admin Panel</h1>
    <div>
        <a href="index.php">Panel</a>
        <a href="kullanicilar.php">Kullanıcılar</a>
        <a href="../cikis.php">Çıkış</a>
    </div>
</nav>

<div class="container">
    <h2>Etkinlik Ekle</h2>
    <?php if ($mesaj) echo mesajGoster($mesaj, "success"); ?>
    <form method="POST" class="form">
        <input type="text" name="baslik" placeholder="Etkinlik Başlığı" required>
        <textarea name="aciklama" placeholder="Açıklama" rows="4"></textarea>
        <input type="datetime-local" name="tarih" required>
        <input type="text" name="konum" placeholder="Konum" required>
        <input type="number" name="kapasite" placeholder="Kapasite" required>
        <button type="submit" class="buton">Etkinlik Ekle</button>
    </form>

    <h2>Mevcut Etkinlikler</h2>
    <table>
        <tr>
            <th>Başlık</th>
            <th>Tarih</th>
            <th>Konum</th>
            <th>Kapasite</th>
            <th>İşlem</th>
        </tr>

        <?php while ($etkinlik = mysqli_fetch_assoc($etkinlikler)): ?>
        <tr>
            <td><?php echo $etkinlik["baslik"]; ?></td>
            <td><?php echo date("d.m.Y H:i", strtotime($etkinlik["tarih"])); ?></td>
            <td><?php echo $etkinlik["konum"]; ?></td>
            <td><?php echo $etkinlik["kapasite"]; ?></td>
            <td><a href="?sil=<?php echo $etkinlik["id"]; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="buton hata">Sil</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>


























</html>