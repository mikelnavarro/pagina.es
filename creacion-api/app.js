// app.js
const express = require('express');
const app = express();
const PORT = 3000;

// Middleware para parsear JSON
app.use(express.json());

// Ruta de prueba
app.get('/', (req, res) => {
  res.send('Bienvenido a la API de libros 📚');
});

// Importar rutas de libros
const librosRouter = require('./routes/libros');
app.use('/api/libros', librosRouter);

// Arrancar servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
