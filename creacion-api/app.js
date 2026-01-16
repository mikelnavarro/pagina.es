// app.js
const express = require('express');
const morgan = require('morgan');   // Importamos Morgan
const db = require('./config/db');

const app = express();
const PORT = process.env.PORT || 3000;



// Middleware
app.use(express.json());
app.use(express.static('public'));
app.use(morgan('dev'));

// Ruta de prueba
app.get('/', (req, res) => {
  res.send('Bienvenido a la API de la Biblioteca');
});

// Importar rutas de libros
const librosRouter = require('./routes/libros');
app.use('/api/libros', librosRouter);

// Inicializar y arrancar
(async () => {
  try {
    await db.connectToDatabase();
    app.listen(PORT, () => {
      console.log(`Servidor corriendo en http://localhost:${PORT}`);
    });
  } catch (error) {
    console.error('Error al iniciar:', error);
    process.exit(1);
  }
})();

module.exports = app;

