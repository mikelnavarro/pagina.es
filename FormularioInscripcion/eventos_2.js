document.getElementById("miform").addEventListener("submit", function (e) {
  e.preventDefault();
  let nombre = document.getElementById("nombre").value;
  let primerapellido = document.getElementById("primerapellido").value;
  let segundoapellido = document.getElementById("segundoapellido").value;
  let dni = document.getElementById("nif").value;
  let texto = document.getElementById("Texto1");



  let persona = {
    nombre: nombre,
    primerapellido: primerapellido,
    segundoapellido: segundoapellido,
    dni: dni,
  };

  localStorage.setItem("persona", JSON.stringify(persona));

  texto.innerHTML +=
    "<p>" +
    "Nombre: " + nombre + "<br>" +
    "Apellido: " + primerapellido + "<br>" +
    "Apellido: " + segundoapellido + "<br>" +
    "DNI (NIF): " + dni + "</p>";
});
/*

window.addEventListener("load", function() {


    let texto = this.document.getElementById("otraCosa");
    let personaGuardar = localStorage.getItem("persona");
    if (personaGuardar) {
    let persona = JSON.parse(personaGuardar);
    texto.innerHTML += "<pr"
    + "Nombre: " + persona.nombre + "<br>"
    + "Apellido: " + persona.primerapellido + "<br>" + "</p>";
}

});*/
