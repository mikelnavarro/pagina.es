document.getElementById("miform").addEventListener("submit", function (e) {
  e.preventDefault();
  let nombre = document.getElementById("nombre").value;
  let primerapellido = document.getElementById("primerapellido").value;
  let texto = document.getElementById("otraCosa");



  let persona = {
    nombre: nombre,
    primerapellido: primerapellido,
  };

  localStorage.setItem("persona", JSON.stringify(persona));

  texto.innerHTML +=
    "<p>" +
    "Nombre: " + nombre + "<br>" +
    "Apellido: " + primerapellido + "<br>" + "</p>";
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
