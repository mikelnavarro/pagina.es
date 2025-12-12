

// Referencias DOM

// Obtener datos
async function getDatos(subregion) {
    try {
        const res = await fetch(`https://restcountries.com/v3.1/subregion/${subregion}`);
        const data = await res.json();
        dibujaCards(data);
    } catch (error) {
        alert('No pude conectarme a la API');
    }
}

function dibujaCards(paises) {
    const galeria = document.getElementById("galeria");
    let htmlPaises = "";
}