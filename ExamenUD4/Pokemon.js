export class Pokemon {
    constructor(nombre, tipo, nivel) {
        this.nombre = nombre;
        this.tipo = tipo;
        this.nivel = nivel;
        this.captura = new Date();
    }
    formatearFecha() {
        const day = this.captura.getDate() + 1;
        const mes = this.captura.getMonth() + 1;
        const year = this.captura.getFullYear()
        return this.captura.toLocaleString("es-ES", {
            day: "2-digit",
            month: "long",
            year: "numeric",
        });
    }
}