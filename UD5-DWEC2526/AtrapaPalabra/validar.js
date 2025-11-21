import { User } from "./User.js";
import { Storage } from "./Storage.js";
const username = document.getElementById("username");
const password = document.getElementById("password");
const inciarSesion = document.getElementById("sesion");

const storage = new Storage();
const arrayUsuarios = storage.load() || [];
inciarSesion.addEventListener("submit", (event) => {
  event.preventDefault(); // Previene por defecto

  
  // validarPassword();
  // validateUsername();

  const inputUser = username.value;
  const inputPassword = password.value;

  // Valida
  arrayUsuarios.forEach((element) => {
    if (username.value == element.name.value) {
      return "atrapar.html";
    } else if (username == "user" && password == "password") {
      return "atrapar.html";
    } else if (username.value !== element.name.value) {
      const user = new User(inputUser, inputPassword);
      arrayUsuarios.push(user); // Se introduce en el Array
      storage.save(arrayUsuarios);
      window.location = "atrapar.html";
    }
  });
});
/* Funcion de validacion user */
function validateUsername() {
  if (username.value.length == 0) {
    username.setCustomValidity("Introduce usuario correcto");
  } else if (arrayUsuarios.includes(username.value)) {
    username.setCustomValidity("Introduce otro nombre");
  } else {
    username.setCustomValidity("");
  }
}
/* Funcion de validacion clave */
function validarPassword() {
  if (password.value.length <= 3) {
    alert("La clave debe tener 3 caracteres o números");
  } else {
    password.setCustomValidity("");
  }
}
