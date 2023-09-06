<?php
include("baglanti.php");

$response = array(); 

if ($baglan) {
   
    $query = "SELECT mevcut_sicaklik FROM sicaklik";
    $result = mysqli_query($baglan, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $mevcutSicaklik = $row['mevcut_sicaklik'];

        $response["temperature"] = $mevcutSicaklik;
    } else {
        $response["error"] = "Veri alınamadı";
    }
} else {
    $response["error"] = "Veritabanı bağlantısı sağlanamadı";
}

if (isset($_POST['istenenSicaklik'])) {
    $istenenSicaklik = floatval($_POST['istenenSicaklik']);
    
    $query = "UPDATE sicaklik SET istenilen_sicaklik = '$istenenSicaklik'";
    $result = mysqli_query($baglan, $query);

    if ($result) {
        $response["success"] = "Sıcaklık güncellendi";
    } else {
        $response["error"] = "Sıcaklık güncellenemedi";
    }
} else {
    $response["error"] = "Sıcaklık değeri alınamadı";
}

echo json_encode($response); 

?>