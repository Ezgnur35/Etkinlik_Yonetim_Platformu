<?php
require_once "includes/session.php";
session_destroy();
header("Location: /Etkinlik_Yonetim_Platformu/giris.php");
exit();
?>