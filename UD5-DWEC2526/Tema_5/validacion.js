// Importaciones
// Variables
const formulario = document.getElementById("formLogin");

const username = document.getElementById("username");
const email = document.getElementById("email");
const pass = document.getElementById("password");

// --- ERRORES ---
const nameError = document.querySelector("#username + span.error");
const emailError = document.querySelector("#email + span.error");
const passError = document.querySelector("#password");


formulario.addEventListener("submit", (evento) => {
  evento.preventDefault();
  validateUser(username);
  validateMail(email);
  validatePassword(pass);
  validate(username);
  nameError.textContent = username.customErrorValidationMessage(username);
  passError.textContent = showError();
});

// Función de validación del usuario
function customErrorValidationMessage(username) {
  if (username.checkValidity()) {
    return "";
  }
  if (username.validity.valueMissing) {
    return "Este campo es obligatorio";
  }
  if (username.validity.tooShort) {
    return `Debe tener al menos ${username.minLength} caracteres`;
  }
  // Y seguiremos comprobando cada atributo que hayamos usado en el HTML
  return "Error en el campo"; // por si se nos ha olvidado comprobar algo
}
// Función con setCheckValidity ===>
const nombresEnUso = ["adrian", "mikel", "lucas", "admin"];
// Para comprobar nombres en uso (nombreEnUso(username))
function validate(username) {
  if (nombresEnUso.includes(username.value)) {
    username.setCustomValidity("Ese nombre de usuario ya está en uso");
  } else {
    username.setCustomValidity("");
  }
}
// Validar user input
function validateUser(username) {
  if (username.validity.typeMismatch) {
    username.setCustomValidity(
      "¡Se esperaba una dirección de correo electrónico!"
    );
  } else {
    username.setCustomValidity("");
  }
}
// Validar el correo email
function validateMail(email) {
  if (email.validity.typeMismatch) {
    email.setCustomValidity(
      "¡Se esperaba una dirección de correo electrónico!"
    );
  } else {
    email.setCustomValidity("");
  }
}
// Validar la Contaseña del usuario
function validatePassword(password) {
  if (password.length <= 3) {
    alert("La clave debe tener 3 caracteres o números");
  }
}

function showError() {
  if (email.validity.valueMissing) {
    emailError.textContent =
      "Debe introducir una dirección de correo electrónico.";
  } else if (email.validity.typeMismatch) {
    emailError.textContent =
      "El valor introducido debe ser una dirección de correo electrónico.";
  } else if (email.validity.tooShort) {
    emailError.textContent =
      "El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.";
  }
  emailError.className = "error activo";
}
