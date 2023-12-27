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

function validatePhoneModel() {}

function validateName() {
  if (customerName.value.length < 5 || customerName.value.length > 20) {
    errorName.innerText =
      "Geben Sie einen Namen mit der Länge 5 - 20 Zeichen ein";
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
