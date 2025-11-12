/* Aprendiendo Eventos en JavaScript

*/

function saludo() {
  alert("Hola");
}
document.getElementById("submitButton").onclick = saludo;
//también podríamos definir la función “sobre la marcha”
//(función “anónima”)
document.getElementById("submitButton").onclick = function () {
  alert("Hola");
};

/*
 Accediendo al valor del Contenido con la palabra 'this': 

 */
function verContenido() {
  alert(this.value);
}
primerapellido.onclick = verContenido;

/*
 Trabajando con innerHTML */
function ponTexto1() {
  let mensaje = prompt("Dame un texto y lo haré un párrafo");
  let etiq = document.getElementById("otraCosa");
  etiq.innerHTML += "<p>" + mensaje + "</p>";
}
function ponTexto2() {
  let mensaje = prompt("Dame un texto y lo haré un párrafo");
  let etiq = document.getElementById("texto");
  etiq.innerHTML += "<p>" + mensaje + "</p>";
}
document.getElementById("otro").onclick = ponTexto2;
document.getElementById("submitButton").onclick = ponTexto1;
function checkForm() {
  let valor = document.getElementById("nombre").value;
  if (valor == "" || valor == null) {
    alert("No puede estar vacío");
    return false;
  } else return true;
}
document.getElementById("myform").onsubmit = checkForm;
