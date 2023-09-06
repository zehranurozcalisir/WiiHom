let list = document.querySelectorAll(".leftContainer li");
function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}
list.forEach((item) => item.addEventListener("mouseover", activeLink));



function divClicked(clickedId) {
  if (confirm("Bu işlemi onaylıyor musunuz?")) {
    var divId = clickedId;
    var pattern = 5;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "database.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText);
      }
    };

    xhr.send("divId=" + divId + "&pattern=" + pattern);
  } else {
    console.log("İşlem iptal edildi.");
  }
}


document.addEventListener("DOMContentLoaded", function () {
  const electricCheckbox = document.getElementById("electricCheckbox");

  electricCheckbox.addEventListener("change", function () {
    const isActive = this.checked;

    fetch("database.php", {
      method: "POST",
      body: JSON.stringify({ isActive: isActive }),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.text())
      .then((message) => {
        console.log(message);
      })
      .catch((error) => {
        console.error(error);
      });
  });
});
document.addEventListener("DOMContentLoaded", function () {
  fetch("get_status.php")
    .then((response) => response.json())
    .then((data) => {
      const electricCheckbox = document.getElementById("electricCheckbox");

      if (data.durum === 1) {
        electricCheckbox.checked = true;
      } else {
        electricCheckbox.checked = false;
      }
    })
    .catch((error) => {
      console.error(error);
    });
});
