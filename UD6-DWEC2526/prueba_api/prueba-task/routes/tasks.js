// routes/tasks.js
const Task = require('../models/task')
const express = require('express');
const router = express.Router();

// Datos simulados (normalmente vendrían de una BD)
let tasks = [
  { id: 1, titulo: 'Cien años de soledad', autor: 'Gabriel García Márquez' },
  { id: 2, titulo: 'El Quijote', autor: 'Miguel de Cervantes' },
  { id: 3, titulo: 'Un poeta en Nueva York', autor: 'Federico García Lorca'}
];

// GET: obtener todos los tasks
router.get('/', (req, res) => {
  res.json(tasks);
});

// GET: obtener un task por ID
router.get('/:id', (req, res) => {
  const task = tasks.find(l => l.id == req.params.id);
  task ? res.json(task) : res.status(404).json({ mensaje: 'task no encontrado' });
});
module.exports = router;