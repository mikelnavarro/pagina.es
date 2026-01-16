const { MongoClient } = require('mongodb');

// URL de conexión a MongoDB
const MONGO_URL = process.env.MONGO_URL || 'mongodb://localhost:27017';
const DB_NAME = process.env.DB_NAME || 'biblioteca_api';

let dbConnection;


module.exports = {
  connectToDatabase: async () => {
    try {
      // MongoClient no necesita opciones en versiones recientes (v5+)
      const client = new MongoClient(MONGO_URL);

      await client.connect();
      dbConnection = client.db(DB_NAME);
      console.log(`Conectado a MongoDB: ${DB_NAME}`);
      return dbConnection;
    } catch (error) {
      console.error('Error conectando a MongoDB:', error);
      throw error;
    }
  },

  getDatabase: () => {
    if (!dbConnection) {
      throw new Error('Base de datos no inicializada');
    }
    return dbConnection;
  }
};