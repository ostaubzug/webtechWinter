function validate() {
  clearAllValidationErrors();
  validateDate();
  validatePhoneModel();
  validateName();
  validateEmail();
  if (!hasValidationErrors()) {
    /* proceed, e.g. send data */
  }
}

function clearAllValidationErrors() {
  errorDate.innerText = "";
  errorModel.innerText = "";
  errorName.innerText = "";
  errorEmail.innerText = "";
}

function validateEmail() {
  let email = document.getElementById("email").value;
  let errorEmail = document.getElementById("errorMail");
  if (!email.checkValidity()) {
    errorEmail.innerText = email.validationMessage;
  }
  if (email.valueMissing) {
    errorEmail.innerText = email.validationMessage;
  }

  //   if (email == "") {
  //     errorEmail.innerText = "Bitte geben Sie eine Email Adresse ein.";
  //   } else if (!validateEmailFormat(email)) {
  //     errorEmail.innerText = "Bitte geben Sie eine gültige Email Adresse ein.";
  //   }
}

function hasValidationErrors() {
  return (
    errorDate.innerText != "" ||
    errorModel.innerText != "" ||
    errorName.innerText != "" ||
    errorEmail.innerText != ""
  );
}
