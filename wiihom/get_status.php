<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wihom";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Elektrik durumunu veritabanından çek
$sql = "SELECT durum FROM genel_elektrik ORDER BY id DESC LIMIT 1"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $durum = $row["durum"];
}

$conn->close();

// Durumu JSON olarak döndür
$response = array("durum" => $durum);
echo json_encode($response);
?>