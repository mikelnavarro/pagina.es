// models/Libro.js
class Libro {
  constructor(titulo, autor, año, precio) {
    this.titulo = titulo;
    this.autor = autor;
    this.año = año;
    this.precio = precio;
    this.createdAt = new Date();
  }

}
module.exports = Libro;