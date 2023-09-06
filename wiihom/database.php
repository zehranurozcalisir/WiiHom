<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wihom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
$divId = $_POST["divId"];
$pattern = $_POST["pattern"];

$sql = "";

if ($divId == 1) {
    $sql = "UPDATE senaryolar SET durum = 1 WHERE id = 1";
} else if ($divId == 2) {
    $sql = "UPDATE senaryolar SET durum = 0 WHERE id = 1";
} else if ($divId == 3) {
    $sql = "UPDATE senaryolar SET durum = 0 WHERE id = 2";
} else if ($divId == 4) {
    $sql = "UPDATE senaryolar SET durum = 1 WHERE id = 2";
}


if ($sql !== "") {
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute()) {
        echo "Veritabanı güncellendi";
    } else {
        echo "Hata: " . $conn->error;
    }
    
    $stmt->close();
}


$data = json_decode(file_get_contents('php://input'), true);
$isActive = $data["isActive"];


$sql1 = "";

if ($isActive ==1){
    $sql1 = "UPDATE genel_elektrik SET durum = 1 WHERE id = 1";
} else if($isActive == 0){
    $sql1 = "UPDATE genel_elektrik SET durum = 0 WHERE id = 1";
}


if ($conn->query($sql1) === TRUE) {
    echo "Veri güncellendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
