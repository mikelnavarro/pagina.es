// Clase Libro

const crypto = require("crypto");
class Libro {
  constructor(titulo, autor, anio) {
    this.id = generateUUID();
    this.titulo = titulo;
    this.autor = autor;
    this.anio = anio;
  }
}
module.exports = Libro;

function generateUUID() {
  return crypto.randomUUID();
}
