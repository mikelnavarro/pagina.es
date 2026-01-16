# Guía Completa: Creación de una API

## 1. ¿Qué es una API?

Una **API (Interfaz de Programación de Aplicaciones)** es un conjunto de reglas que permite que diferentes aplicaciones se comuniquen entre sí. Actúa como un intermediario que procesa solicitudes y devuelve datos en formato JSON.

---

## 2. Estructura de Carpetas en una API

```
mi-api/
├── bin/
│   └── www                    # Archivo ejecutable para iniciar el servidor
├── routes/
│   ├── libros.js              # Rutas para libros (GET, POST, PUT, DELETE)
│   └── usuarios.js            # Rutas para usuarios
├── controllers/               # (Opcional) Lógica de negocio
│   ├── librosController.js
│   └── usuariosController.js
├── models/                    # Modelos de datos (Schemas si usas BD)
│   ├── Libro.js
│   └── Usuario.js
├── middleware/                # Funciones intermedias (autenticación, validación)
│   ├── auth.js
│   └── logger.js
├── config/                    # Configuración (conexión BD, variables env)
│   └── database.js
├── public/                    # Archivos estáticos (CSS, JS, imágenes)
│   ├── css/
│   ├── js/
│   └── index.html
├── app.js                     # Configuración principal de la app
├── package.json               # Dependencias del proyecto
├── .env                       # Variables de entorno (contraseñas, URLs)
└── README.md                  # Documentación del proyecto
```

### Descripción de Carpetas Clave:

| Carpeta | Función |
|---------|---------|
| **bin/www** | Script ejecutable que inicia el servidor. Contiene: `var server = http.createServer(app)` y `server.listen()` |
| **routes/** | Define las rutas (endpoints) de la API. Ejemplo: `/api/libros`, `/api/usuarios` |
| **models/** | Esquemas de datos. Con MongoDB: definen la estructura de documentos |
| **controllers/** | Lógica separada de las rutas. Hace la API más organizada y mantenible |
| **middleware/** | Funciones que se ejecutan antes de las rutas (validación, autenticación) |
| **config/** | Conexión a base de datos y configuraciones globales |
| **public/** | Frontend (HTML, CSS, JS) que consume la API |

---

## 3. Creando un Archivo de Ruta (routes/libros.js)

```javascript
const express = require('express');
const router = express.Router();

// GET - Obtener todos los libros
router.get('/', (req, res) => {
    const libros = [
        { id: 1, titulo: 'El Quijote', autor: 'Cervantes' },
        { id: 2, titulo: '1984', autor: 'Orwell' }
    ];
    res.json(libros);
});

// GET - Obtener un libro por ID
router.get('/:id', (req, res) => {
    res.json({ id: req.params.id, titulo: 'Libro encontrado' });
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

module.exports = router;
```

---

## 4. Configuración Principal (app.js)

```javascript
const express = require('express');
const app = express();

// Middleware
app.use(express.json());
app.use(express.static('public'));

// Rutas
const librosRoutes = require('./routes/libros');
app.use('/api/libros', librosRoutes);

// Ruta raíz
app.get('/', (req, res) => {
    res.send('Bienvenido a mi API');
});

module.exports = app;
```

---

## 5. Archivo Ejecutable (bin/www)

```javascript
#!/usr/bin/env node

const app = require('../app');
const http = require('http');

const PORT = process.env.PORT || 3000;
const server = http.createServer(app);

server.listen(PORT, () => {
    console.log(`Servidor ejecutándose en http://localhost:${PORT}`);
});
```

### Cómo iniciarlo:
- En terminal: `node bin/www`
- O agregar script en `package.json`:
  ```json
  "scripts": {
    "start": "node bin/www",
    "dev": "nodemon bin/www"
  }
  ```
- Ejecutar con: `npm start` o `npm run dev`

---

## 6. Integraciones Avanzadas: MongoDB, Python, etc.

### 6.1 MongoDB

**Instalación:**
```bash
npm install mongoose
```

**Crear modelo (models/Libro.js):**
```javascript
const mongoose = require('mongoose');

const libroSchema = new mongoose.Schema({
    titulo: { type: String, required: true },
    autor: { type: String, required: true },
    año: { type: Number },
    precio: { type: Number }
});

module.exports = mongoose.model('Libro', libroSchema);
```

**Conectar en app.js:**
```javascript
const mongoose = require('mongoose');

mongoose.connect('mongodb://localhost:27017/mi-api', {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

console.log('Conectado a MongoDB');
```

**Usar en rutas:**
```javascript
const Libro = require('../models/Libro');

router.get('/', async (req, res) => {
    const libros = await Libro.find();
    res.json(libros);
});

router.post('/', async (req, res) => {
    const libro = new Libro(req.body);
    await libro.save();
    res.json(libro);
});
```

### 6.2 Python (Backend alternativo con Flask)

Si prefieres usar Python en lugar de Node.js:

**Instalación:**
```bash
pip install flask flask-cors
```

**Crear API (app.py):**
```python
from flask import Flask, jsonify, request
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

libros = [
    {'id': 1, 'titulo': 'El Quijote', 'autor': 'Cervantes'},
    {'id': 2, 'titulo': '1984', 'autor': 'Orwell'}
]

@app.route('/api/libros', methods=['GET'])
def get_libros():
    return jsonify(libros)

@app.route('/api/libros/<int:id>', methods=['GET'])
def get_libro(id):
    libro = next((l for l in libros if l['id'] == id), None)
    return jsonify(libro) if libro else ('No encontrado', 404)

@app.route('/api/libros', methods=['POST'])
def crear_libro():
    nuevo_libro = request.json
    libros.append(nuevo_libro)
    return jsonify(nuevo_libro), 201

if __name__ == '__main__':
    app.run(debug=True, port=3000)
```

**Iniciar:**
```bash
python app.py
```

### 6.3 PostgreSQL

**Instalación:**
```bash
npm install pg
```

**Conexión básica:**
```javascript
const { Pool } = require('pg');

const pool = new Pool({
    user: 'usuario',
    host: 'localhost',
    database: 'mi_api',
    password: 'contraseña',
    port: 5432,
});

router.get('/', async (req, res) => {
    const result = await pool.query('SELECT * FROM libros');
    res.json(result.rows);
});
```

---

## 7. Usando REST Client en VSC

La extensión **REST Client** de VSC permite hacer peticiones HTTP sin necesidad de Postman.

### 7.1 Instalación
1. Ve a **Extensiones** en VSC
2. Busca "REST Client"
3. Instala la extensión de Huachao Mao

### 7.2 Crear archivo de pruebas (api.http)

```http
### Obtener todos los libros
GET http://localhost:3000/api/libros

### Obtener un libro específico
GET http://localhost:3000/api/libros/1

### Crear un nuevo libro
POST http://localhost:3000/api/libros
Content-Type: application/json

{
  "titulo": "Don Juan",
  "autor": "Lord Byron",
  "año": 1819,
  "precio": 25.99
}

### Actualizar un libro
PUT http://localhost:3000/api/libros/1
Content-Type: application/json

{
  "titulo": "El Quijote Actualizado",
  "autor": "Cervantes",
  "año": 1605
}

### Eliminar un libro
DELETE http://localhost:3000/api/libros/1

### Con parámetros de consulta
GET http://localhost:3000/api/libros?autor=Cervantes&año=1605

### Con headers personalizado
GET http://localhost:3000/api/libros
Authorization: Bearer token123456
X-Custom-Header: valor-personalizado
```

### 7.3 Usando variables en REST Client

```http
@baseUrl = http://localhost:3000
@apiUrl = {{baseUrl}}/api/libros

### GET con variable
GET {{apiUrl}}

### POST con variable
POST {{apiUrl}}
Content-Type: application/json

{
  "titulo": "Nuevo Libro",
  "autor": "Autor",
  "precio": 19.99
}
```

### 7.4 Cómo usar
- Click en **"Send Request"** sobre cada petición
- O usar atajo: `Ctrl+Alt+R` (Windows/Linux) o `Cmd+Alt+R` (Mac)
- Resultados aparecen en panel lateral

---

## 8. Pasos para Crear una API desde Cero

### 8.1 Inicialización del Proyecto

```bash
# Crear carpeta
mkdir mi-api
cd mi-api

# Inicializar Node.js
npm init -y

# Instalar dependencias
npm install express

# Instalar herramientas de desarrollo
npm install --save-dev nodemon
```

### 8.2 Crear estructura

```bash
mkdir bin routes controllers models middleware config public
mkdir public/css public/js
touch bin/www app.js
touch routes/libros.js
```

### 8.3 Configurar package.json

```json
{
  "name": "mi-api",
  "version": "1.0.0",
  "description": "API de prueba",
  "main": "app.js",
  "scripts": {
    "start": "node bin/www",
    "dev": "nodemon bin/www"
  },
  "dependencies": {
    "express": "^4.18.0"
  },
  "devDependencies": {
    "nodemon": "^2.0.0"
  }
}
```

### 8.4 Crear archivos básicos

**app.js:**
```javascript
const express = require('express');
const app = express();

app.use(express.json());
app.use(express.static('public'));

const librosRoutes = require('./routes/libros');
app.use('/api/libros', librosRoutes);

module.exports = app;
```

**bin/www:**
```javascript
#!/usr/bin/env node
const app = require('../app');
const http = require('http');

const server = http.createServer(app);
server.listen(3000, () => console.log('API en puerto 3000'));
```

**routes/libros.js:**
```javascript
const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
    res.json([{ id: 1, titulo: 'Ejemplo' }]);
});

module.exports = router;
```

### 8.5 Iniciar la API

```bash
npm run dev
```

---

## 9. Variables de Entorno (.env)

**Instalar dotenv:**
```bash
npm install dotenv
```

**Archivo .env:**
```
PORT=3000
MONGODB_URI=mongodb://localhost:27017/mi-api
NODE_ENV=development
JWT_SECRET=tu_clave_secreta_aqui
API_KEY=abc123xyz789
```

**Usar en app.js:**
```javascript
require('dotenv').config();

const PORT = process.env.PORT || 3000;
const MONGODB_URI = process.env.MONGODB_URI;
```

---

## 10. Resumen Rápido

| Aspecto | Descripción |
|--------|------------|
| **Carpeta bin/www** | Inicia el servidor HTTP |
| **Carpeta routes/** | Define endpoints (/api/libros, etc.) |
| **Carpeta models/** | Estructura de datos (especialmente con BD) |
| **app.js** | Configuración central de Express |
| **REST Client** | Prueba peticiones sin Postman |
| **MongoDB** | Base de datos NoSQL (documentos JSON) |
| **PostgreSQL** | Base de datos relacional SQL |
| **Python/Flask** | Alternativa a Node.js para backend |
| **Iniciar** | `npm run dev` o `node bin/www` |

---

## Conclusión

Una API bien estructurada es fundamental para:
- ✅ Organizar el código
- ✅ Facilitar mantenimiento futuro
- ✅ Escalar la aplicación
- ✅ Colaborar en equipo

Con esta estructura, puedes integrar fácilmente bases de datos, autenticación, y expandir tu API según necesites.
