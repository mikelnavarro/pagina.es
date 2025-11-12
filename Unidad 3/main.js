import { DIVISA_EURO, DIVISA_DOLAR, DIVISA_LIBRA, EURO_TO_DOLLAR, LIBRA_TO_DOLLAR } from "./constantes.js";
// Por nombre de la clase
const btnSubmit = document.getElementsByClassName("inputSubmit")[0];
btnSubmit.addEventListener("click",function (e) { // Atender al botón
    // click submit
    
    
    

    const element = document.getElementsByTagName("input")[0]; // Elemento input
    let valor = parseInt(element.value)

    // Get divisas
    const divisaFrom = document.getElementById("divisaFrom"); // Id (el otro tamb)
    const divisaTo = document.getElementById("divisaTo");


    const divisaValueFrom = divisaFrom[divisaFrom.innerHTML];
    // Valores Divisa



    



    e.preventDefault(); // Prevener que se envie por defecto







});


// funcion
function addHistoric(valueOrigin,valueExchanged,divisaFrom,divisaTo){

    const historic = document.getElementById("historic").value;
    
    // Crear elemento HTML
    const nuevaLine = document.createElement("p");
    const fechaActual = new Date(Date.now());
    const textoLinea = 
    document.createTextNode(`${fechaActual.getMonth()}/${fechaActual.getFullYear()}${fechaActual.getDay()}:${fechaActual.getHours()}:${fechaActual.getMinutes()}}
            Importe ${valueOrigin} ${divisaFrom} ${divisaTo}`);
    
    nuevaLine.appendChild(textoLinea);
    historico.appendChild(nuevaLinea);

    

}