<?php
require_once "../includes/baglanti.php";
require_once "../includes/session.php";
require_once "../includes/fonksiyonlar.php";
adminKontrol();

if (isset($_GET["admin_yap"])) {
    $uid = (int)$_GET["admin_yap"];
    mysqli_query($baglanti, "UPDATE kullanicilar SET rol='admin' WHERE id=$uid");
    yonlendir("admin/kullanicilar.php");
}

if (isset($_GET["sil"])) {
    $uid = (int)$_GET["sil"];
    mysqli_query($baglanti, "DELETE FROM kayitlar WHERE kullanici_id=$uid");
    mysqli_query($baglanti, "DELETE FROM kullanicilar WHERE id=$uid");
    yonlendir("admin/kullanicilar.php");
}

$kullanicilar = mysqli_query($baglanti, "SELECT * FROM kullanicilar ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Yönetimi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav>
    <h1>Admin Panel</h1>
    <div>
        <a href="index.php">Panel</a>
        <a href="etkinlikler.php">Etkinlikler</a>
        <a href="../cikis.php">Çıkış</a>
    </div>
</nav>

<div class="container">
    <h2>Kullanıcılar</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>İsim</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Kayıt Tarihi</th>
            <th>İşlem</th>
        </tr>
        <?php while ($k = mysqli_fetch_assoc($kullanicilar)): ?>
        <tr>
            <td><?php echo $k["id"]; ?></td>
            <td><?php echo $k["isim"]; ?></td>
            <td><?php echo $k["email"]; ?></td>
            <td><?php echo $k["rol"]; ?></td>
            <td><?php echo date("d.m.Y", strtotime($k["created_at"])); ?></td>
            <td>
                <?php if ($k["rol"] !== "admin"): ?>
                    <a href="?admin_yap=<?php echo $k["id"]; ?>" class="buton">Admin Yap</a>
                <?php endif; ?>
                <?php if ($k["id"] !== $_SESSION["kullanici_id"]): ?>
                    <a href="?sil=<?php echo $k["id"]; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="buton hata">Sil</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>