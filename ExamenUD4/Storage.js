import { Pokemon } from './Pokemon.js';
export class GuardarPokemon {

    save(lipokemon) {
        localStorage.setItem("lipokemon",JSON.stringify(lipokemon));
    }
    load() {
        const datos = JSON.parse(localStorage.getItem("lipokemon"));
        if (datos) {
            return datos.map(poke => {
                const pk = new Pokemon(poke.nombre,poke.tipo,poke.nivel);
                pk.formatearFecha();
                return pk;
            });
        }
    }  
    
    remove(lipokemon) {
        localStorage.removeItem("lipokemon");
    }
}
