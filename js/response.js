function displayServerResponse() {
  let xhr = new XMLHttpRequest();

  xhr.onload = function () {
    let htmlOutput = document.getElementById("output");
    let responseData = JSON.parse(xhr.responseText);
    htmlOutput.innerHTML = getResponseMessage(responseData);
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
    " kontaktieren, um Ihnen ein persönliches Angebot zu unterbreiten.<br><br> Wir haben bereits " +
    responseData.numberOfRequests +
    " Angebote an Ihre Mail Adresse zugestellt.";

  return message;
}

function getJSONSendObject() {
  let phonemodel = document.getElementById("phonemodel").value;
  let email = document.getElementById("email").value;
  let kaufdatum = document.getElementById("kaufdatum").value;
  let name = document.getElementById("name").value;

  return JSON.stringify({
    phonemodel: phonemodel,
    email: email,
    datetime: kaufdatum,
    name: name,
  });
}
