<?php
$sunucu="localhost";
$kullanici="root";
$sifre="";
$veriTabani="etkinlik_db";

$baglanti=mysqli_connect($sunucu,$kullanici,$sifre,$veriTabani);

if(!$baglanti){
    echo("bağlantı hatası: ".mysqli_connect_error());
    exit();
}

mysqli_set_charset($baglanti,"utf8");


?>