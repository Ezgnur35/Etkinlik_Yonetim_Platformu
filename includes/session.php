<?php
session_start();

function girisKontrol(){
    if(!isset($_SESSION["kullanici_id"])){
        header("Location: /Etkinlik_Yonetim_Platformu/giris.php");
    exit();
    }
}



function adminKontrol(){
    girisKontrol();
      if ($_SESSION["rol"] !== "admin") {
        header("Location: /Etkinlik_Yonetim_Platformu/index.php");
        exit();
    }
}



















?>