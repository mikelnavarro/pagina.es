// objeto.types
const fragmento = document.createDocumentFragment();
const main = document.querySelector("main");
const template = document.createElement("template");
main.innerHTML = "";

const apiRequest = async () => {
    
    const respuesta = await fetch("https://pokeapi.co/api/v2/pokemon/1");
    const data = await respuesta.json();
};

const paintPokemon = (data) => {
    
};

const paintPokemonForType = async (e) => {
    
};

document.addEventListener("DOMContentLoaded", () => {
    peticionApi();
});

document.addEventListener("click", (e) => {
    
});

// `
//                     <div class="card">
//                         <img 
//                         loading="lazy"
//                         class="card_img" 
//                         src=${src} 
//                         alt="">
//                         <h2 class="card_title">${name}</h2>
//                         <div class="types">
//                             
//                         </div>
//                     </div>
//                 `;
