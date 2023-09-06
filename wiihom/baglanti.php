<?php 
$sunucu = "localhost";
$vt_name = "wihom";
$vt_kullanici = "root";
$vt_sifre = "";
$baglan = mysqli_connect($sunucu, $vt_kullanici, $vt_sifre, $vt_name);
if ($baglan) {
    mysqli_query($baglan, "SET CHARACTER SET 'utf8'");
    mysqli_query($baglan, "SET NAMES 'utf8'");
}
?>
