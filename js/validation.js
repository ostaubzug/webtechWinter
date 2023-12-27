let date = document.getElementById("kaufdatum");
let phonemodel = document.getElementById("phonemodel");
let customerName = document.getElementById("name");
let email = document.getElementById("email");

let errorDate = document.getElementById("errorDate");
let errorModel = document.getElementById("errorModel");
let errorName = document.getElementById("errorName");
let errorEmail = document.getElementById("errorMail");

function isInputValid() {
  clearAllValidationErrors();
  validateEmail();
  validateName();
  validatePhoneModel();
  validateDate();

  if (!hasValidationErrors()) {
    return true;
  }
  return false;
}

function clearAllValidationErrors() {
  errorDate.innerText = "";
  errorModel.innerText = "";
  errorName.innerText = "";
  errorEmail.innerText = "";
}

function validateDate() {
  var now = new Date();
  if (date.validity.valueMissing) {
    errorDate.innerText = "Bitte füllen Sie dieses Feld aus";
  } else if (new Date(date.value) > now) {
    errorDate.innerText = "Das Datum muss in der Vergangenheit liegen";
  } else if (!date.checkValidity()) {
    errorDate.innerText = "Bitte geben Sie ein gültiges Datum ein";
  }
}

function validatePhoneModel() {
  if (phonemodel.value == "" || phonemodel.value < 1 || phonemodel.value > 6) {
    errorModel.innerText = "Bitte wählen Sie ein gültiges Modell aus";
  }
}

function validateName() {
  if (customerName.value.length < 5 || customerName.value.length > 20) {
    errorName.innerText =
      "Geben Sie einen Namen mit der Länge 5 - 20 Zeichen ein";
    //check if there are any numbers in the name with regex
  } else if (/\d/.test(customerName.value)) {
    errorName.innerText = "Der Name darf keine Zahlen enthalten";
  } else if (!customerName.checkValidity()) {
    errorName.innerText = "Bitte geben Sie einen gültigen Namen ein";
  }
}

function validateEmail() {
  if (email.validity.valueMissing) {
    errorEmail.innerText = "Bitte füllen Sie dieses Feld aus";
  } else if (!email.checkValidity()) {
    errorEmail.innerText = "ungültige E-Mail Adresse";
  }
}

function hasValidationErrors() {
  return (
    errorDate.innerText != "" ||
    errorModel.innerText != "" ||
    errorName.innerText != "" ||
    errorEmail.innerText != ""
  );
}
