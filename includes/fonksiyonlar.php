<?php

function temizle($veri){
    $veri=trim($veri);
    $veri=stripslashes($veri);
    $veri = htmlspecialchars($veri, ENT_QUOTES, "UTF-8");
        return $veri;
}



function yonlendir($url) {
    header("Location: /Etkinlik_Yonetim_Platformu/" . $url);
    exit();
}





function mesajGoster($mesaj, $tur = "success") {
    return '<div class="mesaj ' . $tur . '">' . $mesaj . '</div>';
}


function etkinlikleriGetir($baglanti) {
    $sorgu = "SELECT e.*, k.isim as organizator 
              FROM etkinlikler e 
              LEFT JOIN kullanicilar k ON e.kullanici_id = k.id 
              ORDER BY e.tarih ASC";
    return mysqli_query($baglanti, $sorgu);
}


function etkinlikDetay($baglanti, $id) {
    $id = (int)$id;
    $sorgu = "SELECT e.*, k.isim as organizator 
              FROM etkinlikler e 
              LEFT JOIN kullanicilar k ON e.kullanici_id = k.id 
              WHERE e.id = $id";
    return mysqli_fetch_assoc(mysqli_query($baglanti, $sorgu));
}







function kayitliMi($baglanti, $kullanici_id, $etkinlik_id) {
    $kullanici_id = (int)$kullanici_id;
    $etkinlik_id = (int)$etkinlik_id;
    $sorgu = "SELECT id FROM kayitlar 
              WHERE kullanici_id = $kullanici_id 
              AND etkinlik_id = $etkinlik_id";
              
    $sonuc = mysqli_query($baglanti, $sorgu);
    return mysqli_num_rows($sonuc) > 0;
}

?>