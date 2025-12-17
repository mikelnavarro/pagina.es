import { Persona } from './Persona.js';
export class Storage {
    save(arrayPersonas){
        localStorage.setItem("arrayPersonas",JSON.stringify(arrayPersonas));
    }
    load(){
        const data = localStorage.getItem("arrayPersonas");
        if (data) {
            data = JSON.parse(arrayPersonas);
            const arrayPersonas = objetos.map((persona) => {
                const p = new Persona(persona.nombre,persona.apellido,persona.dni);
            });
        }
    }
}