function validate() {
  clearErrors();
  validateName();
  validateEmail();
  if (!hasValidationErrors()) {
    /* proceed, e.g. send data */
  }
}

function clearValidationErrors() {
  errorName.innerText = "";
  errorEmail.innerText = "";
}
function hasValidationErrors() {
  return errorName.innerText != "" || errorEmail.innerText != "";
}