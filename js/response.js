function displayServerResponse() {
  let xhr = new XMLHttpRequest();

  xhr.onload = function () {
    let htmlOutput = document.getElementById("output");
    let responseData = JSON.parse(xhr.responseText);

    if (xhr.status == 200) {
      htmlOutput.innerHTML = getResponseMessage(responseData);
    } else {
      htmlOutput.innerText = xhr.responseText;
    }
  };

  xhr.onerror = function () {
    document.getElementById("output").innerText =
      "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später noch einmal.";
  };

  xhr.ontimeout = function () {
    document.getElementById("output").innerText =
      "Die Anfrage ist abgelaufen. Bitte versuchen Sie es später noch einmal.";
  };

  xhr.open("POST", "backend.php?function=processRequest", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(getJSONSendObject());
}

function getResponseMessage(responseData) {
  let message =
    "Gratulation " +
    responseData.name +
    "! Ihr Handy ist noch " +
    responseData.phoneValue +
    " CHF wert.<br>Wir werden Sie unter " +
    responseData.email +
    " kontaktieren, um Ihnen ein persönliches Angebot zu unterbreiten.<br><br> In dieser Session wurden bereits " +
    responseData.numberOfRequests +
    " Angebote an Ihre Mail Adresse zugestellt. Insgesamt sind es " +
    responseData.numberOfTotalRequests +
    " Angebote welche an Ihre Adresse versendet wurden.";

  return message;
}

function getJSONSendObject() {
  let phonemodel = document.getElementById("phonemodel").value;
  let email = document.getElementById("email").value;
  let kaufdatum = document.getElementById("kaufdatum").value;
  let name = document.getElementById("name").value;

  return JSON.stringify({
    date: kaufdatum,
    phonemodel: phonemodel,
    email: email,
    name: name,
  });
}
