<?php
include("baglanti.php");
session_start();
$sensorler = mysqli_query($baglan, "SELECT sensortetik.img , odalar.odalar, sensorler.sensor, sensortetik.borderColor FROM sensorler,odalar,sensortetik WHERE sensortetik.sensor_id=sensorler.id and sensortetik.oda_id=odalar.oda_id ORDER BY sensortetik.sensor_id DESC LIMIT 3");
$istenilenSicaklik = mysqli_query($baglan, "SELECT istenilen_sicaklik FROM sicaklik");
$istenilenSicaklikResult = mysqli_query($baglan, "SELECT istenilen_sicaklik FROM sicaklik");
if ($istenilenSicaklikResult) {
    $row = mysqli_fetch_assoc($istenilenSicaklikResult);
    $istenilenSicaklik = $row['istenilen_sicaklik'];
} else {
    // Handle query failure
}

$img = array();
$oda = array();
$sensor = array();
$border = array();
while ($row = mysqli_fetch_row($sensorler)) {
    $img[] = $row[0];
    $oda[] = $row[1];
    $sensor[] = $row[2];
    $border[] = $row[3];
} // Sonuçları diziye ekle
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assests/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <title>WiHom</title>
</head>

<body>
    <!-- Menu -->
    <div class="container">
        <section class="leftContainer">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fab fa-brands fa-joomla"></i></span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon"><i class="fas fa-table"></i></span>

                        </span>

                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-home"></i></span>
                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-regular fa-lightbulb"></i></span>
                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-person-booth"></i></span>



                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-plug"></i></span>

                    </a>
                </li>

                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-snowflake"></i></span>

                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-video"></i></span>


                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-cog"></i></span>

                    </a>
                </li>
                <li>
                    <a href="bos.php">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>

                    </a>
                </li>

            </ul>
        </section>
        <section class="rightContainer">
            <div class="topContainer">
                <div class="weather">
                    <div class="comment">
                        <h1>WiiHOM Villa</h1>
                        <p class="commentt"> Evine Hoşgeldin! Hava kalitesi iyi ve taze, <br> bugün dışarı çıkabilirsin.</p>
                        <span> <b><i class="fas fa-temperature-high"></i> 21 °C</b> Dış Ortam Sıcaklığı</span>
                        <p class="commentWeather"> <i class="fas fa-cloud"></i> Parçalı Bulutlu</p>
                    </div>
                    <div class="image"> <img src="assests/img/cloudSun.png"> </div>
                </div>
                <div class="scenario">
                    <h3>Senaryolar</h3>
                    <div class="group1">
                        <div class="purpleDiv" id="myDiv" onclick="divClicked(1)"> Tüm Lambaları Aç </div>
                        <div class="pinkDiv" onclick="divClicked(2)"> Tüm Lambaları Kapat</div>
                    </div>

                    <div class="group2">
                        <div class="blueDiv" onclick="divClicked(3)"> Ben Gidiyorum</div>
                        <div class="yellowDiv" onclick="divClicked(4)">Ben Geldim</div>
                    </div>
                </div>
                <div class="result"></div>

            </div>
            <div class="bottomContainer">
                <div class="leftContainerr">
                    <div class="div1">
                        <div class="alarm">
                            <div class="icon-container">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="text-container">
                                <p>Alarm</p>
                            </div>
                        </div>

                        <div class="intercom">
                            <div class="icon-container">
                                <i class="fab fa-intercom"></i>
                            </div>
                            <div class="text-container">
                                <p>İnterkom</p>
                            </div>
                        </div>
                        <div class="blinds">
                            <div class="icon-container">
                                <i class="fas fa-person-booth"></i>
                            </div>
                            <div class="text-container">
                                <p>Panjurlar</p>
                            </div>
                        </div>
                        <div class="electric">
                            <div class="active">
                                <div class="left-content">
                                    <p>Aktif</p>
                                </div>
                                <div class="right-content"> <label class="electricSwitch"> <input type="checkbox" id="electricCheckbox" checked>
                                        <span class="slider3"></span></label></div>
                            </div>
                            <div> <i class="fas fa-bolt" style="font-size:30px; margin-left:5px"></i></div>
                            <div class="general">
                                <p> Genel Elektrik</p>
                            </div>
                        </div>
                    </div>
                    <div class="div2">
                        <h1>Sensörler</h1>
                        <div class="layout">
                            <div class="bedroom" style="border-color:<?php echo isset($border[0]) ? $border[0] : ""; ?>">
                                <div><img src="<?php echo isset($img[0]) ? $img[0] : ""; ?>"></div>
                                <div class="text-container">
                                    <div>
                                        <p> <?php echo isset($sensor[0]) ? $sensor[0] : ""; ?></p>
                                    </div>
                                    <div> <span><?php echo isset($oda[0]) ? $oda[0] : ""; ?></span></div>
                                </div>
                            </div>

                            <div class="corridor" style="border-color:<?php echo isset($border[0]) ? $border[2] : ""; ?>">
                                <div><img src="<?php echo isset($img[0]) ? $img[2] : ""; ?>"></div>
                                <div class="text-container">
                                    <div>
                                        <p><?php echo isset($sensor[0]) ? $sensor[2] : ""; ?></p>
                                    </div>
                                    <div> <span><?php echo isset($oda[0]) ? $oda[2] : ""; ?></span></div>
                                </div>
                            </div>
                            <div class="basement" style="border-color:<?php echo isset($border[0]) ? $border[1] : ""; ?>">
                                <div><img src="<?php echo isset($img[0]) ? $img[1] : ""; ?>"></div>
                                <div class="text-container">
                                    <div>
                                        <p><?php echo isset($sensor[0]) ? $sensor[1] : ""; ?></p>
                                    </div>
                                    <div> <span><?php echo isset($oda[0]) ? $oda[1] : ""; ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="div3">
                        <div class="yellow"> <i class="fas fa-key"></i></div>
                        <div class="pink"> <i class="fas fa-bell"></i></div>
                        <div class="purple"> <img src="assests/icon/elevator_buttons_svgrepo_com"></div>
                        <div class="blue"><i class="fas fa-user-secret"></i></div>
                        <div class="purple"> <img src="assests/icon/open_gate_svgrepo_com"></div>
                        <div class="pink"><img src="assests/icon/garage_svgrepo_com"></div>
                        <div class="yellow"> <img src="assests/icon/door_lock_svgrepo_com"></div>
                    </div>
                </div>
                <div class="rightContainerr">
                    <div class="room">
                        <div>
                            <form action="" method="POST" class="form1">
                                <select name="rooms" class="rooms" id="rooms">
                                    <option value="1">Yatak Odası</option>
                                    <option value="2">Salon</option>
                                    <option value="3">Mutfak</option>
                                    <option value="4">Çocuk Odası</option>
                                </select>
                                <br><br>
                            </form>
                        </div>
                        <div> <label class="switchBlue"> <input type="checkbox" checked>
                                <span class="slider2"></span></label>
                            <label class="switchPurple"> <input type="checkbox" checked>
                                <span class="slider"></span></label>
                        </div>
                    </div>
                    <div class="circle">
                        <div id="gauge">
                            <div id="major-ticks">

                            </div>
                            <div id="minor-ticks">
                                <span style="--i:1"></span>
                                <span style="--i:2"></span>
                                <span style="--i:3"></span>
                                <span style="--i:4"></span>
                                <span style="--i:5"></span>
                                <span style="--i:6"></span>
                                <span style="--i:7"></span>
                                <span style="--i:8"></span>
                                <span style="--i:9"></span>
                                <span style="--i:10"></span>
                                <span style="--i:11"></span>
                                <span style="--i:12"></span>
                                <span style="--i:13"></span>
                                <span style="--i:14"></span>
                                <span style="--i:15"></span>
                                <span style="--i:16"></span>
                                <span style="--i:17"></span>
                                <span style="--i:18"></span>
                                <span style="--i:19"></span>
                                <span style="--i:20"></span>
                            </div>

                            <div id="minior-ticks-bottom-mask"></div>
                            <div id="bottom-circle"></div>
                            <svg version="1.1" baseProfile="full" width="190" height="190" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#b96e85" />
                                        <stop offset="100%" stop-color="#ae69bb" />
                                    </linearGradient>
                                </defs>
                                <path id="arc" d="M5 95 A80 80 0 0 1 185 95 " stroke="url(#gradient)" fill="none" stroke-width="10" stroke-linecap="round" />
                            </svg>
                            <div id="center-circle">
                                <span id="temperature"></span>
                            </div>
                        </div>
                    </div>
                    <div class="temperature">
                        <div> <button class="negativeButton" onclick="azalt()"> <i class="fas fa-xs fa-minus"></i></button></div>
                        <input type="button" id="sonuc" value="<?php echo isset($istenilenSicaklik) ? $istenilenSicaklik : ''; ?>">


                        <div> <button class="positiveButton" onclick="arttir()"> <i class="fas fa-xs fa-plus"></i></button></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
    <script src="mevcutSicaklik.js"></script>
</body>

</html>