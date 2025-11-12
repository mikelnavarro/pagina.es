"use strict";
export class Tren {
  nombre;
  velocidad;
  tipo;
  fechaAlta;
  constructor(nombre, velocidad, tipo) {
    this.nombre = nombre;
    this.velocidad = velocidad;
    this.tipo = tipo;
    this.fechaAlta = new Date();
  }
  formatearFecha() {
    let dia = this.fechaAlta.getDate();
    let mes = this.fechaAlta.getMonth() + 1;
    let year = this.fechaAlta.getFullYear();
    
    
    const formateada = `${dia}/${mes}/${year}`;
    return formateada;
    /* return this.fechaAlta.toLocaleString("es-ES", {
      day: "2-digit",
      month: "long",
      year: "numeric",
    });*/
  }
}
