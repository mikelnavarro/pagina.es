// routes/libros.js
const express = require('express');
const router = express.Router();

const { ObjectId } = require('mongodb');


// Obtén la colección de libros
const librosCollection = db.collection('libros');
// Datos simulados (normalmente vendrían de una BD)
let libros = [
  { id: 1, titulo: 'Cien años de soledad', autor: 'Gabriel García Márquez' },
  { id: 2, titulo: 'El Quijote', autor: 'Miguel de Cervantes' },
  { id: 3, titulo: 'Un poeta en Nueva York', autor: 'Federico García Lorca'}
];


// GET: obtener todos los libros
router.get('/', (req, res) => {
  res.json(libros);
});

// GET: obtener un libro por ID
router.get('/:id', (req, res) => {
  const libro = libros.find(l => l.id == req.params.id);
  libro ? res.json(libro) : res.status(404).json({ mensaje: 'Libro no encontrado' });
});


// POST - Crear un nuevo libro
router.post('/', (req, res) => {
    res.json({ mensaje: 'Libro creado', libro: req.body });
});

// PUT - Actualizar un libro
router.put('/:id', (req, res) => {
    res.json({ mensaje: 'Libro actualizado', id: req.params.id });
});

// DELETE - Eliminar un libro
router.delete('/:id', (req, res) => {
    res.json({ mensaje: 'Libro eliminado', id: req.params.id });
});