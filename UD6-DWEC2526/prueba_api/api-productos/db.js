const mongoose = require('mongoose');


const conectarDB = async () =&gt; {
  try {
    await mongoose.connect('mongodb://localhost:27017/productosdb', {
      useNewUrlParser: true,
      useUnifiedTopology: true
    });
    console.log('Conectado a MongoDB');
  } catch (error) {
    console.error('Error al conectar a MongoDB', error);
    process.exit(1);
  }
};

module.exports = conectarDB;