var temperature = document.getElementById("temperature");
var arc = document.getElementById("arc");

var xhr = new XMLHttpRequest();
xhr.open("GET", "mevcutSicaklik.php", true);
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var temperatureValue = response.temperature;
            temperature.textContent = temperatureValue + '°C';
    
            const arc_length = arc.getTotalLength();
            const step = arc_length / (30 - 10);
            const value = (temperatureValue - 10) * step;
            arc.style.strokeDasharray = `${value} ${arc_length - value}`;
    
            console.log("Mevcut sıcaklık: " + temperatureValue);
        } else {
            console.error("Hata: " + xhr.status);
        }
    }
};
xhr.send();

function sendNewTemperature(istenenSicaklik) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "mevcutSicaklik.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("istenenSicaklik=" + istenenSicaklik);
}

function arttir() {
    var sonuc = document.getElementById("sonuc");
    sonuc.value = Number(sonuc.value) + 0.5;
    sendNewTemperature(sonuc.value);
}

function azalt() {
    var sonuc = document.getElementById("sonuc");
    sonuc.value = Number(sonuc.value) - 0.5;
    sendNewTemperature(sonuc.value);
}
