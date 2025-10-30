"use sctrict";
import "script.js";
import * as myModule from "script.js";


document.getElementById("crear").addEventListener("click", function () {
let nombre = document.getElementById("nombre");
let numPaginas = document.getElementById("pag");
let prestar = document.getElementById("prestamo");

function validate() {
    let y = document.forms["creacionPag"]["nombre"].value;
    let b = document.forms["creacionPag"]["pag"].value;
    const eti = document.getElementByClassName("id01");
    if ((nombre==null) || (nombre==" ")){
        eti.innerHTML = "False";
        return false;
    }

    if ((b=="  ") || (y=="")) {
        alert("th");
        return false;
    }
}
});


localStorage.setItem();
localStorage.setItem();

