// routes/libros.js
const express = require('express');
const router = express.Router();
const db = require('../config/db'); // Importa el módulo db.js
const { ObjectId } = require('mongodb');

// Obtén la colección de libros
const getLibrosCollection = () => {
  const dbConnection = db.getDatabase();
  return dbConnection.collection('libros');
};


// Obtener todos los libros (GET /api/libros)
router.get('/', async (req, res) => {
  try {
    const librosCollection = getLibrosCollection();
    const libros = await librosCollection.find().toArray();
    res.json(libros);
  } catch (error) {
    console.error('Error al obtener libros:', error);
    res.status(500).json({ error: 'Error al obtener libros' });
  }
});

// Añadir un libro (POST /api/libros)
router.post('/', async (req, res) => {
  try {
    const librosCollection = getLibrosCollection();
    const nuevoLibro = req.body;
    const result = await librosCollection.insertOne(nuevoLibro);
    res.status(201).json(result);
  } catch (error) {
    console.error('Error al añadir libro:', error);
    res.status(500).json({ error: 'Error al añadir libro' });
  }
});

// Eliminar un libro (DELETE /api/libros/:id)
router.delete('/:id', async (req, res) => {
  try {
    const librosCollection = getLibrosCollection();
    const id = req.params.id;
    const result = await librosCollection.deleteOne({ _id: new ObjectId(id) });
    res.json(result);
  } catch (error) {
    console.error('Error al eliminar libro:', error);
    res.status(500).json({ error: 'Error al eliminar libro' });
  }
});
module.exports = router;