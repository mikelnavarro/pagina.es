# MongoDB API con Docker - Guía Completa
Antes de empezar, entiende que hay **2 formas diferentes** de hacerlo:

### Opción A: RECOMENDADA - Docker Compose (TODO en UN comando)
```powershell
# 1. Un solo comando que hace TODA la magia
docker-compose up -d

# ✅ Crea contenedor MongoDB
# ✅ Crea contenedor API
# ✅ Los conecta automáticamente
# ✅ Configura volúmenes y redes
```
**Pros:** Sencillo, automático, todo junto  
**Contras:** Menos control manual  
**Ideal para:** Desarrollo rápido, producción

### Opción B: Manual - docker run (Lo que hiciste en clase)
```powershell
# 1. Crear MongoDB manualmente
docker run -d --name mongodb-biblioteca ... mongo:6

# 2. Ejecutar API en Windows (no en contenedor)
npm start

# ✅ API en Windows conecta a MongoDB en contenedor
# ✅ Más control paso a paso
```
**Pros:** Entiende cada paso, flexible  
**Contras:** Más comandos, más manual  
**Ideal para:** Aprender cómo funcionan contenedores

### ¿Cuál elegir?
- **Si solo quieres que funcione:** Opción A (docker-compose)
- **Si quieres entender cómo funciona:** Opción B (docker run + npm start local)

---

## Índice
1. [Estructura de Archivos y Carpetas](#1-estructura-de-archivos-y-carpetas)
2. [MongoDB sin Mongoose (Driver Nativo)](#2-mongodb-sin-mongoose-driver-nativo)
3. [Docker y Contenerización](#3-docker-y-contenerización)
4. [Volúmenes para Persistencia de Datos](#4-volúmenes-para-persistencia-de-datos)
5. [Preguntas de Reflexión](#5-preguntas-de-reflexión)
6. [Ejercicio Práctico Final](#6-ejercicio-práctico-final)

---

## 1. Estructura de Archivos y Carpetas

### 1.1 Árbol de Directorios Completo

```
creacion-api/
├── bin/
│   └── www                          # Archivo ejecutable del servidor
├── routes/
│   ├── libros.js                    # Rutas para CRUD de libros
│   └── usuarios.js                  # Rutas para usuarios (opcional)
├── controllers/
│   ├── librosController.js          # Lógica de negocio para libros
│   └── usuariosController.js        # Lógica de negocio para usuarios
├── models/
│   ├── Libro.js                     # Esquema/modelo de Libro
│   └── Usuario.js                   # Esquema/modelo de Usuario
├── config/
│   └── database.js                  # Conexión a MongoDB
├── middleware/
│   ├── auth.js                      # Autenticación (JWT, etc.)
│   ├── validation.js                # Validación de datos
│   └── errorHandler.js              # Manejo de errores
├── public/
│   ├── index.html                   # Frontend principal
│   ├── css/
│   │   └── estilo.css               # Estilos CSS
│   └── js/
│       └── script.js                # Lógica del cliente
├── docker/
│   ├── Dockerfile                   # Definición de imagen Docker
│   └── docker-compose.yml           # Orquestación de contenedores
├── app.js                           # Configuración principal de Express
├── package.json                     # Dependencias del proyecto
├── package-lock.json                # Lock de dependencias
├── .env                             # Variables de entorno
├── .dockerignore                    # Archivos a ignorar en Docker
├── .gitignore                       # Archivos a ignorar en Git
├── api.http                         # Archivo para pruebas REST Client
└── README.md                        # Documentación del proyecto
```

### 1.2 Descripción Detallada de Cada Carpeta

| Carpeta | Archivos | Propósito |
|---------|----------|----------|
| **bin/** | `www` | Script ejecutable que inicia el servidor HTTP |
| **routes/** | `*.js` | Define los endpoints (GET, POST, PUT, DELETE) |
| **controllers/** | `*Controller.js` | Contiene la lógica de negocio separada de las rutas |
| **models/** | `*.js` | Define la estructura de datos (schemas) |
| **config/** | `database.js` | Gestiona la conexión a MongoDB |
| **middleware/** | `*.js` | Funciones intermedias (validación, autenticación, logs) |
| **public/** | HTML, CSS, JS | Archivos estáticos del frontend |
| **docker/** | `Dockerfile`, `docker-compose.yml` | Configuración de contenedores |

### 1.3 Flujo de una Petición

```
Cliente (REST Client/Postman)
    ↓
HTTP Request (GET/POST/PUT/DELETE)
    ↓
app.js (enrutador)
    ↓
middleware/ (validación, autenticación)
    ↓
routes/ (mapeo de rutas)
    ↓
controllers/ (lógica de negocio)
    ↓
models/ (esquemas de datos)
    ↓
config/database.js (conexión MongoDB)
    ↓
MongoDB (base de datos)
    ↓
Respuesta JSON
    ↓
Cliente
```

---

## 2. MongoDB sin Mongoose (Driver Nativo)

MongoDB es una base de datos **NoSQL** basada en documentos JSON. El driver nativo de MongoDB permite trabajar sin necesidad de una librería como Mongoose.

### 2.1 Instalación

```bash
npm install mongodb dotenv
```

### 2.2 Configurar Conexión (config/database.js)

```javascript
const { MongoClient } = require('mongodb');

// URL de conexión a MongoDB
const MONGO_URL = process.env.MONGO_URL || 'mongodb://localhost:27017';
const DB_NAME = process.env.DB_NAME || 'biblioteca_api';

let dbConnection;

module.exports = {
  connectToDatabase: async () => {
    try {
      const client = new MongoClient(MONGO_URL, {
        useNewUrlParser: true,
        useUnifiedTopology: true
      });

      await client.connect();
      dbConnection = client.db(DB_NAME);
      console.log(`✅ Conectado a MongoDB: ${DB_NAME}`);
      return dbConnection;
    } catch (error) {
      console.error('❌ Error conectando a MongoDB:', error);
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
```

### 2.3 Crear Modelos (models/Libro.js)

```javascript
// models/Libro.js
class Libro {
  constructor(titulo, autor, año, precio) {
    this.titulo = titulo;
    this.autor = autor;
    this.año = año;
    this.precio = precio;
    this.createdAt = new Date();
  }

  // Validar datos
  static validar(libro) {
    const errores = [];
    
    if (!libro.titulo || libro.titulo.trim() === '') {
      errores.push('El título es requerido');
    }
    if (!libro.autor || libro.autor.trim() === '') {
      errores.push('El autor es requerido');
    }
    if (libro.precio && typeof libro.precio !== 'number') {
      errores.push('El precio debe ser un número');
    }
    
    return {
      valido: errores.length === 0,
      errores
    };
  }
}

module.exports = Libro;
```

### 2.4 Crear Controllers (controllers/librosController.js)

```javascript
// controllers/librosController.js
const { ObjectId } = require('mongodb');
const Libro = require('../models/Libro');
const db = require('../config/database');

class LibrosController {
  // Obtener todos los libros
  static async obtenerTodos(req, res) {
    try {
      const database = db.getDatabase();
      const libros = await database.collection('libros').find({}).toArray();
      res.json(libros);
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  }

  // Obtener un libro por ID
  static async obtenerPorId(req, res) {
    try {
      const database = db.getDatabase();
      const id = new ObjectId(req.params.id);
      const libro = await database.collection('libros').findOne({ _id: id });
      
      if (!libro) {
        return res.status(404).json({ mensaje: 'Libro no encontrado' });
      }
      res.json(libro);
    } catch (error) {
      res.status(400).json({ error: 'ID inválido' });
    }
  }

  // Crear un nuevo libro
  static async crear(req, res) {
    try {
      // Validar datos
      const validacion = Libro.validar(req.body);
      if (!validacion.valido) {
        return res.status(400).json({ errores: validacion.errores });
      }

      const nuevoLibro = new Libro(
        req.body.titulo,
        req.body.autor,
        req.body.año,
        req.body.precio
      );

      const database = db.getDatabase();
      const resultado = await database.collection('libros').insertOne(nuevoLibro);

      res.status(201).json({
        mensaje: 'Libro creado exitosamente',
        id: resultado.insertedId,
        libro: nuevoLibro
      });
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  }

  // Actualizar un libro
  static async actualizar(req, res) {
    try {
      const id = new ObjectId(req.params.id);
      const database = db.getDatabase();

      const resultado = await database.collection('libros').updateOne(
        { _id: id },
        { $set: req.body }
      );

      if (resultado.matchedCount === 0) {
        return res.status(404).json({ mensaje: 'Libro no encontrado' });
      }

      res.json({ mensaje: 'Libro actualizado', id });
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  }

  // Eliminar un libro
  static async eliminar(req, res) {
    try {
      const id = new ObjectId(req.params.id);
      const database = db.getDatabase();

      const resultado = await database.collection('libros').deleteOne({ _id: id });

      if (resultado.deletedCount === 0) {
        return res.status(404).json({ mensaje: 'Libro no encontrado' });
      }

      res.json({ mensaje: 'Libro eliminado exitosamente' });
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  }
}

module.exports = LibrosController;
```

### 2.5 Crear Rutas (routes/libros.js)

```javascript
// routes/libros.js
const express = require('express');
const router = express.Router();
const LibrosController = require('../controllers/librosController');

// Rutas CRUD
router.get('/', LibrosController.obtenerTodos);
router.get('/:id', LibrosController.obtenerPorId);
router.post('/', LibrosController.crear);
router.put('/:id', LibrosController.actualizar);
router.delete('/:id', LibrosController.eliminar);

module.exports = router;
```

### 2.6 Actualizar app.js

```javascript
// app.js
const express = require('express');
const morgan = require('morgan');
const db = require('./config/database');
const librosRouter = require('./routes/libros');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(express.json());
app.use(express.static('public'));
app.use(morgan('dev'));

// Ruta de prueba
app.get('/', (req, res) => {
  res.send('API de Biblioteca - Conectada a MongoDB 📚');
});

// Rutas
app.use('/api/libros', librosRouter);

// Inicializar y arrancar
(async () => {
  try {
    await db.connectToDatabase();
    app.listen(PORT, () => {
      console.log(`✅ Servidor en http://localhost:${PORT}`);
    });
  } catch (error) {
    console.error('Error al iniciar:', error);
    process.exit(1);
  }
})();

module.exports = app;
```

---

## 2.7 Crear Contenedor de MongoDB (Método Manual con RUN)

En clase aprendiste a crear contenedores de forma manual usando `docker run`. Este método es perfecto para entender qué ocurre internamente cuando usamos Docker Compose.

### 2.7.1 Comando Básico para Crear Contenedor MongoDB

```bash
docker run -d \
  --name mongodb-biblioteca \
  -e MONGO_INITDB_ROOT_USERNAME=admin \
  -e MONGO_INITDB_ROOT_PASSWORD=password123 \
  -e MONGO_INITDB_DATABASE=biblioteca_api \
  -p 27017:27017 \
  -v mongodb_data:/data/db \
  mongo:6
```

### 2.7.2 Explicación Línea por Línea

| Parámetro | Explicación | Ejemplo |
|-----------|------------|---------|
| `docker run` | Crea e inicia un nuevo contenedor | - |
| `-d` | Ejecutar en background (detached) | No ocupa la terminal |
| `--name` | Nombre del contenedor | `mongodb-biblioteca` |
| `-e VARIABLE` | Variables de entorno (usuario, contraseña, BD) | `-e MONGO_INITDB_ROOT_USERNAME=admin` |
| `-p HOST:CONTENEDOR` | Mapeo de puertos (externo:interno) | `-p 27017:27017` |
| `-v VOLUMEN:/ruta` | Volumen para persistencia de datos | `-v mongodb_data:/data/db` |
| `mongo:6` | Imagen a usar (MongoDB versión 6) | - |

### 2.7.3 Desglose Completo del Comando

```bash
docker run -d \
  --name mongodb-biblioteca              # Nombre que verás en "docker ps"
  -e MONGO_INITDB_ROOT_USERNAME=admin    # Usuario root de MongoDB
  -e MONGO_INITDB_ROOT_PASSWORD=password123  # Contraseña (SECURA EN PRODUCCIÓN)
  -e MONGO_INITDB_DATABASE=biblioteca_api    # Base de datos inicial
  -p 27017:27017                         # Puerto: Windows:Contenedor
  -v mongodb_data:/data/db               # Volumen nombrado para datos
  mongo:6                                # Imagen oficial de MongoDB v6
```

### 2.7.4 Paso a Paso: Crear y Verificar el Contenedor

**Paso 1: Crear el contenedor**

```powershell
# Abrir PowerShell y ejecutar:
docker run -d `
  --name mongodb-biblioteca `
  -e MONGO_INITDB_ROOT_USERNAME=admin `
  -e MONGO_INITDB_ROOT_PASSWORD=password123 `
  -e MONGO_INITDB_DATABASE=biblioteca_api `
  -p 27017:27017 `
  -v mongodb_data:/data/db `
  mongo:6
```

**Salida esperada:**
```
abc123def456ghi789jkl012mnopqrst  # ID del contenedor
```

**Paso 2: Verificar que está corriendo**

```powershell
docker ps
```

**Salida esperada:**
```
CONTAINER ID   IMAGE      PORTS                    NAMES
abc123de...    mongo:6    0.0.0.0:27017->27017    mongodb-biblioteca
```

**Paso 3: Ver logs**

```powershell
docker logs mongodb-biblioteca
```

**Salida esperada:**
```
Waiting for connections
...
Listener started on 27017
```

### 2.7.5 Conectar la API al Contenedor MongoDB

Una vez que el contenedor está corriendo, la API puede conectarse usando:

```javascript
// config/db.js
const MONGO_URL = 'mongodb://admin:password123@localhost:27017/biblioteca_api?authSource=admin';
```

**Componentes de la URL de conexión:**

```
mongodb://admin:password123@localhost:27017/biblioteca_api?authSource=admin
│         │     │            │         │     │     │              │
│         │     │            │         │     │     └─ Puerto       │
│         │     │            │         │     └───── Hostname/IP    │
│         │     │            │         └───────── BD inicial        │
│         │     │            └─────────────────── Especificar auth  │
│         │     └──────────────────────────────── Contraseña        │
│         └────────────────────────────────────── Usuario           │
└──────────────────────────────────────────────── Protocolo         
```

### 2.7.6 Verifying Data Persistence (Volumen Funciona)

**Paso 1: Acceder a MongoDB shell**

```powershell
docker exec -it mongodb-biblioteca mongosh -u admin -p password123 --authenticationDatabase admin
```

**Paso 2: Crear una colección con datos**

```javascript
// Dentro de MongoDB shell:
use biblioteca_api
db.libros.insertOne({
  titulo: "El Quijote",
  autor: "Cervantes",
  año: 1605
})
db.libros.find().pretty()
```

**Paso 3: Detener contenedor (sin eliminar volumen)**

```powershell
docker stop mongodb-biblioteca
```

**Paso 4: Reiniciar el contenedor**

```powershell
docker start mongodb-biblioteca
```

**Paso 5: Verificar que los datos siguen ahí**

```powershell
docker exec -it mongodb-biblioteca mongosh -u admin -p password123 --authenticationDatabase admin
# use biblioteca_api
# db.libros.find().pretty()

# ¡El libro sigue existiendo! ✅ Volumen funciona
```

### 2.7.7 Comandos Relacionados con el Contenedor

```powershell
# Ver información del contenedor
docker inspect mongodb-biblioteca

# Ver logs en tiempo real
docker logs -f mongodb-biblioteca

# Ejecutar comando en el contenedor
docker exec mongodb-biblioteca mongosh --version

# Acceder a shell interactivo
docker exec -it mongodb-biblioteca /bin/bash

# Detener contenedor
docker stop mongodb-biblioteca

# Reiniciar contenedor
docker start mongodb-biblioteca

# Eliminar contenedor (mantiene volumen)
docker rm mongodb-biblioteca

# Eliminar contenedor y volumen (¡CUIDADO!)
docker rm -v mongodb-biblioteca
```

### 2.7.8 Relación entre RUN Manual y docker-compose

Cuando usas `docker-compose.yml`, Docker automáticamente hace lo equivalente a:

```yaml
# docker-compose.yml es equivalente a:
services:
  mongodb:
    image: mongo:6
    container_name: mongodb-biblioteca
    # ↑ Equivalente a: docker run --name mongodb-biblioteca mongo:6
    
    environment:
      MONGO_INITDB_ROOT_USERNAME: admin
      # ↑ Equivalente a: -e MONGO_INITDB_ROOT_USERNAME=admin
      
    ports:
      - "27017:27017"
      # ↑ Equivalente a: -p 27017:27017
      
    volumes:
      - mongodb_data:/data/db
      # ↑ Equivalente a: -v mongodb_data:/data/db

volumes:
  mongodb_data:
    driver: local
```

**La diferencia:**
- `docker run`: Manual, un comando a la vez
- `docker-compose`: Automático, todo de una vez

### 2.7.9 Comparativa: docker run vs docker-compose

| Aspecto | docker run | docker-compose |
|--------|-----------|-----------------|
| **Comando** | `docker run -d -e -p -v ...` | `docker-compose up -d` |
| **Múltiples servicios** | Debe ejecutar varios `docker run` | Todo en un archivo `.yml` |
| **Volúmenes** | `-v mongodb_data:/data/db` | Define en sección `volumes:` |
| **Redes** | Debe crear red manualmente | Crea automáticamente |
| **Variables .env** | Especificadas con `-e` | Cargadas de `.env` |
| **Facilidad** | Más manual | Más automatizado |
| **Reproducibilidad** | Difícil recordar el comando | Fácil: archivo guardado |

### 2.7.10 OPCIÓN B SIMPLE: Contenedor MongoDB + API en Windows (LO QUE HICISTE EN CLASE)

Si solo creaste un contenedor MongoDB y quieres ejecutar la API en Windows directamente, aquí está el flujo:

#### Paso 1: Crear Contenedor MongoDB (una sola vez)

```powershell
docker run -d `
  --name mongodb-biblioteca `
  -e MONGO_INITDB_ROOT_USERNAME=admin `
  -e MONGO_INITDB_ROOT_PASSWORD=password123 `
  -e MONGO_INITDB_DATABASE=biblioteca_api `
  -p 27017:27017 `
  -v mongodb_data:/data/db `
  mongo:6
```

**Verificar que funciona:**
```powershell
docker ps
# Deberías ver: mongodb-biblioteca corriendo
```

#### Paso 2: Instalar Dependencias de la API (solo primera vez)

```powershell
# Navegar a la carpeta del proyecto
cd D:\xampp\htdocs\pagina.es\creacion-api

# Instalar dependencias
npm install
```

#### Paso 3: Configurar .env para Conectarse a MongoDB Local

```env
# .env
PORT=3000
MONGO_URL=mongodb://admin:password123@localhost:27017/biblioteca_api?authSource=admin
DB_NAME=biblioteca_api
NODE_ENV=development
```

**Punto clave:** Usa `localhost` (no `mongodb-biblioteca`) porque la API corre en Windows, no en un contenedor.

#### Paso 4: Iniciar la API en Windows (cada vez que trabajes)

```powershell
npm start

# O con desarrollo en vivo
npm run dev
```

**Salida esperada:**
```
✅ Servidor en http://localhost:3000
✅ Conectado a MongoDB en mongodb://localhost:27017
```

#### Resultado: 1 Contenedor + 1 Proceso Local

```
┌─────────────────────────────────────────┐
│ Tu Máquina Windows                      │
│                                         │
│ ┌─────────────────┐                    │
│ │ Terminal (npm)  │                    │
│ │ API corriendo   │                    │
│ │ localhost:3000  │                    │
│ └────────┬────────┘                    │
│          │ conecta a                   │
│          ↓                             │
│ ┌──────────────────────────────┐      │
│ │ Docker (Contenedor MongoDB)  │      │
│ │ localhost:27017              │      │
│ │ Volumen: mongodb_data ✅     │      │
│ └──────────────────────────────┘      │
│                                         │
└─────────────────────────────────────────┘
```

#### Ventajas de esta Opción B:
- ✅ Contenedor MongoDB persiste datos con volumen
- ✅ API corre localmente (rápida, fácil de editar)
- ✅ Cambios en código se ven instantáneamente
- ✅ Debugging fácil desde VS Code

#### Comandos Diarios

```powershell
# INICIO
docker run -d ... mongo:6              # Primera vez solo
npm start                              # Cada vez que abras el proyecto

# DESARROLLO
# Edita archivos en VS Code
# Los cambios son instantáneos (con nodemon)

# AL FINAL
Ctrl+C en terminal                     # Detiene API
docker stop mongodb-biblioteca         # Detiene MongoDB (opcional)

# PRÓXIMO DÍA
docker start mongodb-biblioteca        # Reinicia MongoDB
npm start                              # Reinicia API
```

---

### 2.7.11 OPCIÓN A COMPLETA: Dos Contenedores (Avanzado)

Si quieres tener AMBOS (API + MongoDB) en contenedores usando dos `docker run` separados, sigue esto:

#### Crear Contenedor de la API (Segundo Contenedor)

Una vez que MongoDB está corriendo, necesitas crear y ejecutar la API en su propio contenedor.

#### Paso 1: Construir la Imagen (docker build)

El **Dockerfile** es la receta que le dice a Docker cómo construir la imagen de tu API.

```dockerfile
# Dockerfile
FROM node:18-alpine              # Base: Node.js versión 18 (ligera)

WORKDIR /app                     # Directorio de trabajo en el contenedor

COPY package*.json ./            # Copiar dependencias

RUN npm install                  # Instalar las dependencias

COPY . .                         # Copiar todo el código

EXPOSE 3000                      # Documentar que usa puerto 3000

CMD ["npm", "start"]             # Comando al iniciar el contenedor
```

**Construir la imagen:**

```powershell
# Desde la carpeta del proyecto (donde está el Dockerfile)
cd D:\xampp\htdocs\pagina.es\creacion-api

# Construir la imagen
docker build -t mi-api:1.0 .
#             │       │   │
#             │       │   └─ Contexto (.) = usa archivos del directorio actual
#             │       └───── Versión/tag
#             └───────────── Nombre de la imagen
```

**Salida esperada:**
```
[1/5] FROM node:18-alpine
[2/5] WORKDIR /app
[3/5] COPY package*.json ./
[4/5] RUN npm install
[5/5] COPY . .
Successfully tagged mi-api:1.0
```

**Verificar que la imagen se creó:**

```powershell
docker images

# Deberías ver:
# REPOSITORY   TAG     IMAGE ID      CREATED         SIZE
# mi-api       1.0     abc123def456  2 minutes ago    150MB
```

#### Paso 2: Ejecutar la API en un Contenedor (docker run)

Ahora ejecutas la imagen creada en un nuevo contenedor. Este contenedor se conectará al contenedor MongoDB que ya está corriendo.

```powershell
docker run -d `
  --name api-biblioteca `
  -p 3000:3000 `
  -e MONGO_URL=mongodb://admin:password123@mongodb-biblioteca:27017/biblioteca_api?authSource=admin `
  -e DB_NAME=biblioteca_api `
  -v api_code:/app `
  --link mongodb-biblioteca:mongodb `
  mi-api:1.0
```

**Explicación línea por línea:**

| Parámetro | Explicación |
|-----------|------------|
| `docker run -d` | Ejecutar contenedor en background |
| `--name api-biblioteca` | Nombre del contenedor |
| `-p 3000:3000` | Mapear puerto 3000 (Windows:Contenedor) |
| `-e MONGO_URL=...` | Variable de entorno para conectar a MongoDB |
| `-e DB_NAME=...` | Nombre de la base de datos |
| `-v api_code:/app` | Volumen para persistencia del código |
| `--link mongodb-biblioteca:mongodb` | Conectar con contenedor MongoDB |
| `mi-api:1.0` | Imagen a usar (la que acabas de construir) |

**Punto clave:** La URL usa `mongodb-biblioteca` (nombre del contenedor MongoDB) en lugar de `localhost`. Docker resuelve automáticamente este nombre al IP del otro contenedor.

#### Paso 3: Verificar que está corriendo

```powershell
# Ver contenedores activos
docker ps

# Deberías ver ambos:
# CONTAINER ID   IMAGE          NAMES
# abc123...      mongo:6        mongodb-biblioteca
# def456...      mi-api:1.0     api-biblioteca
```

#### Paso 4: Ver logs de la API

```powershell
docker logs -f api-biblioteca

# Esperado:
# ✅ Servidor en http://localhost:3000
# ✅ Conectado a MongoDB
```

#### Paso 5: Probar que funciona

```powershell
# Probar endpoint GET
curl http://localhost:3000/api/libros

# O abre en navegador:
# http://localhost:3000
```

### 2.8.9 Resumen: Flujo Completo Manual (docker run) - OPCIÓN AVANZADA

```
PASO 1: Crear contenedor MongoDB
┌──────────────────────────────────────────────────┐
│ docker run -d --name mongodb-biblioteca \        │
│   -e MONGO_INITDB_ROOT_USERNAME=admin \          │
│   -e MONGO_INITDB_ROOT_PASSWORD=password123 \    │
│   -p 27017:27017 \                               │
│   -v mongodb_data:/data/db \                     │
│   mongo:6                                        │
└──────────────────────────────────────────────────┘
           ↓
      ✅ MongoDB corriendo
      
PASO 2: Construir imagen de la API
┌──────────────────────────────────────────────────┐
│ docker build -t mi-api:1.0 .                     │
└──────────────────────────────────────────────────┘
           ↓
      ✅ Imagen creada
      
PASO 3: Ejecutar contenedor de la API
┌──────────────────────────────────────────────────┐
│ docker run -d --name api-biblioteca \            │
│   -p 3000:3000 \                                 │
│   -e MONGO_URL=mongodb://...@mongodb-biblioteca  │
│   --link mongodb-biblioteca \                    │
│   mi-api:1.0                                     │
└──────────────────────────────────────────────────┘
           ↓
      ✅ API corriendo
      ✅ Conectada a MongoDB
      
RESULTADO: 2 contenedores comunicándose
┌─────────────────────────────────────────────────┐
│ Tu Máquina Windows                              │
│                                                  │
│ localhost:3000  ────→  Contenedor API          │
│                           ↓                     │
│                    Conecta a: mongodb-biblioteca │
│                           ↓                     │
│ localhost:27017 ────→  Contenedor MongoDB      │
│                           ↓                     │
│                    Volumen: mongodb_data        │
│                                                  │
└─────────────────────────────────────────────────┘
```

### 2.7.12 Con Volumen para Desarrollo

Si quieres que los cambios en el código se reflejen en vivo (bind mount):

```powershell
docker run -d `
  --name api-biblioteca `
  -p 3000:3000 `
  -e MONGO_URL=mongodb://admin:password123@mongodb-biblioteca:27017/biblioteca_api?authSource=admin `
  -v ${PWD}:/app `
  -v /app/node_modules `
  --link mongodb-biblioteca:mongodb `
  mi-api:1.0
```

**Diferencias:**
| Parámetro | Significado |
|-----------|------------|
| `-v ${PWD}:/app` | Sincroniza tu carpeta actual con /app del contenedor |
| `-v /app/node_modules` | Excluye node_modules (usa los del contenedor) |

**Resultado:** Editas archivos en VS Code y se reflejan automáticamente en el contenedor.

### 2.7.14 Comandos Útiles para Gestionar Contenedores

```powershell
# Ver logs en tiempo real
docker logs -f api-biblioteca

# Ejecutar comando en la API
docker exec api-biblioteca npm list

# Detener la API
docker stop api-biblioteca

# Reiniciar la API
docker start api-biblioteca

# Eliminar la API (mantiene volumen)
docker rm api-biblioteca

# Ver todos los contenedores (incluso los detenidos)
docker ps -a

# Detener todos los contenedores
docker stop $(docker ps -q)

# Eliminar todos los contenedores
docker rm $(docker ps -aq)
```

### 2.7.15 Resumen: Todas las Opciones

### 2.7.15 Resumen: Todas las Opciones

**OPCIÓN A (SIMPLE - Recomendada para Clase):**
```powershell
# 1. Crear MongoDB en contenedor
docker run -d --name mongodb-biblioteca ... mongo:6

# 2. Instalar dependencias API
npm install

# 3. Iniciar API localmente
npm start

# Resultado: 1 contenedor (MongoDB) + 1 proceso (API en Windows)
```

**OPCIÓN B (AVANZADA - Dos Contenedores):**
```powershell
# 1. Crear MongoDB
docker run -d --name mongodb-biblioteca ... mongo:6

# 2. Construir imagen API
docker build -t mi-api:1.0 .

# 3. Ejecutar contenedor API
docker run -d --name api-biblioteca ... mi-api:1.0

# Resultado: 2 contenedores (MongoDB + API)
```

**OPCIÓN C (MÁS SIMPLE - docker-compose):**
```powershell
# Todo en un comando
docker-compose up -d

# Resultado: 2 contenedores (MongoDB + API) orquestados automáticamente
```

**Comparación:**

| Aspecto | Opción A (Simple) | Opción B (Manual 2x) | Opción C (Compose) |
|--------|-----------------|---------------------|------------------|
| **Complejidad** | ⭐ Fácil | ⭐⭐⭐ Media | ⭐⭐ Simple |
| **Pasos** | docker run + npm start | docker run + build + docker run | docker-compose up |
| **Desarrollo** | Cambios instantáneos | Cambios con volumen | Cambios instantáneos |
| **API en** | Windows (local) | Contenedor | Contenedor |
| **MongoDB en** | Contenedor | Contenedor | Contenedor |
| **Para aprender** | ✅ Lo que hizo en clase | ✅ Entiender Docker profundo | ❌ Menos control |
| **Para producción** | ❌ No recomendado | ✅ Funciona | ✅ Mejor |

**Mi recomendación:** Usa **Opción A** (lo que probablemente hiciste en clase) - simple, funcional y entiendes cada paso.

---

## 3. Docker y Contenerización

Docker permite empaquetar tu aplicación con todas sus dependencias en un contenedor portátil.

### 3.1 OPCIÓN C: Usar docker-compose (Todo Automático)

# Exponer puerto
EXPOSE 3000

# Comando para iniciar la aplicación
CMD ["npm", "start"]
```

### 3.2 Crear .dockerignore

```
node_modules
npm-debug.log
.git
.gitignore
.env.local
.DS_Store
```

### 3.3 Crear docker-compose.yml

```yaml
version: '3.8'

services:
  # Servicio de MongoDB
  mongodb:
    image: mongo:6
    container_name: mongodb-biblioteca
    ports:
      - "27017:27017"
    environment:
      MONGO_INITDB_ROOT_USERNAME: admin
      MONGO_INITDB_ROOT_PASSWORD: password123
      MONGO_INITDB_DATABASE: biblioteca_api
    volumes:
      - mongodb_data:/data/db        # Persistencia de datos
      - mongodb_config:/data/configdb
    networks:
      - api-network
    healthcheck:
      test: ["CMD", "mongosh", "--eval", "db.adminCommand('ping')"]
      interval: 10s
      timeout: 5s
      retries: 5

  # Servicio de la API
  api:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: api-biblioteca
    ports:
      - "3000:3000"
    environment:
      MONGO_URL: mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin
      DB_NAME: biblioteca_api
      NODE_ENV: production
    depends_on:
      mongodb:
        condition: service_healthy
    volumes:
      - ./:/app              # Volumen para desarrollo
      - /app/node_modules   # Excluir node_modules del host
    networks:
      - api-network
    command: npm start

# Volúmenes nombrados
volumes:
  mongodb_data:
    driver: local
  mongodb_config:
    driver: local

# Red compartida
networks:
  api-network:
    driver: bridge
```

### 3.4 Configurar .env

```env
# .env
PORT=3000
MONGO_URL=mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin
DB_NAME=biblioteca_api
NODE_ENV=development
```

---

## 4. Volúmenes para Persistencia de Datos

Los volúmenes en Docker aseguran que los datos persistan incluso cuando los contenedores se eliminen.

### 4.1 Tipos de Volúmenes

```yaml
volumes:
  # Volumen nombrado (recomendado)
  mongodb_data:
    driver: local

  # Bind mount (mapeo de directorio local)
  # - ./data:/data/db
```

### 4.2 Comandos Docker Útiles

```bash
# Construir la imagen
docker build -t mi-api:1.0 .

# Ver volúmenes
docker volume ls

# Inspeccionar un volumen
docker volume inspect mongodb_data

# Eliminar volumen (¡CUIDADO! Borra los datos)
docker volume rm mongodb_data

# Ejecutar contenedores
docker-compose up

# Ejecutar en segundo plano
docker-compose up -d

# Ver logs
docker-compose logs -f api
docker-compose logs -f mongodb

# Detener contenedores
docker-compose down

# Eliminar volúmenes (¡CUIDADO!)
docker-compose down -v

# Ejecutar comando en contenedor
docker-compose exec api npm run dev

# Acceder a MongoDB desde el contenedor
docker-compose exec mongodb mongosh -u admin -p password123 --authenticationDatabase admin
```

### 4.3 Verificar Persistencia de Datos

```bash
# 1. Iniciar contenedores
docker-compose up -d

# 2. Crear un libro via API (ver sección REST Client)

# 3. Ver logs
docker-compose logs mongodb

# 4. Detener sin eliminar volúmenes
docker-compose stop

# 5. Volver a iniciar
docker-compose up -d

# 6. Verificar que el libro sigue en la BD
curl http://localhost:3000/api/libros

# Los datos persisten ✅
```

---

## 5. Preguntas de Reflexión

### 5.1 Conceptos Clave

1. **¿Cuál es la diferencia entre un volumen nombrado y un bind mount?**
   - Volumen nombrado: Gestionado por Docker, acceso a través de `/var/lib/docker/volumes`
   - Bind mount: Mapea un directorio del host al contenedor

2. **¿Por qué es importante usar `depends_on` y `healthcheck` en docker-compose?**
   - `depends_on`: Garantiza que MongoDB esté listo antes de iniciar la API
   - `healthcheck`: Verifica que MongoDB responda correctamente

3. **¿Qué ventajas tiene usar el driver nativo de MongoDB sobre Mongoose?**
   - ✅ Menor overhead (menos abstracción)
   - ✅ Control total sobre las operaciones
   - ✅ Mejor para aplicaciones simples
   - ❌ Menos validaciones automáticas
   - ❌ Más código boilerplate

4. **¿Cómo manejo errores de conexión a MongoDB?**
   - Usar `healthcheck` en docker-compose
   - Implementar reintentos con backoff exponencial
   - Usar try-catch en las operaciones

5. **¿Qué datos deberían estar en `.env` y cuáles en `docker-compose.yml`?**
   - `.env`: Contraseñas, claves secretas, URLs sensibles
   - `docker-compose.yml`: Configuración de servicios, puertos públicos

6. **¿Cómo aseguro que los datos de MongoDB persistan?**
   - Usar volúmenes nombrados: `volumes: - mongodb_data:/data/db`
   - Nunca usar `docker-compose down -v` en producción

---

## 6. Ejercicio Práctico Final

### 6.1 Objetivos

- ✅ Implementar una API completa con MongoDB y driver nativo
- ✅ Contenerizar con Docker
- ✅ Garantizar persistencia de datos
- ✅ Hacer peticiones CRUD funcionales
- ✅ Entender toda la arquitectura

### 6.2 Pasos a Completar

#### **Paso 1: Preparar la Estructura**

```bash
# Crear carpeta del proyecto
mkdir mi-api-docker
cd mi-api-docker

# Crear estructura de carpetas
mkdir bin config routes controllers models middleware public docker
mkdir public/css public/js

# Crear archivos
touch app.js .env .dockerignore
touch bin/www
touch config/database.js
touch routes/libros.js
touch controllers/librosController.js
touch models/Libro.js
touch Dockerfile
touch docker-compose.yml
touch api.http
```

#### **Paso 2: Configurar package.json**

```json
{
  "name": "mi-api-docker",
  "version": "1.0.0",
  "main": "app.js",
  "scripts": {
    "start": "node app.js",
    "dev": "nodemon app.js"
  },
  "dependencies": {
    "express": "^4.18.0",
    "mongodb": "^5.0.0",
    "morgan": "^1.10.1",
    "dotenv": "^16.0.0"
  },
  "devDependencies": {
    "nodemon": "^2.0.0"
  }
}
```

#### **Paso 3: Implementar MongoDB (Driver Nativo)**

Usa los códigos proporcionados en la sección 2 (config/database.js, controllers/librosController.js, etc.)

#### **Paso 4: Crear Dockerfile y docker-compose.yml**

Usa los códigos de la sección 3.1, 3.2 y 3.3

#### **Paso 5: Crear Archivo de Pruebas (api.http)**

```http
### BASE URL
@baseUrl = http://localhost:3000

### 1. Obtener todos los libros
GET {{baseUrl}}/api/libros

### 2. Crear un nuevo libro
POST {{baseUrl}}/api/libros
Content-Type: application/json

{
  "titulo": "One Hundred Years of Solitude",
  "autor": "Gabriel García Márquez",
  "año": 1967,
  "precio": 29.99
}

### 3. Crear otro libro
POST {{baseUrl}}/api/libros
Content-Type: application/json

{
  "titulo": "The Hobbit",
  "autor": "J.R.R. Tolkien",
  "año": 1937,
  "precio": 19.99
}

### 4. Obtener un libro por ID (cambiar el ID por uno real)
GET {{baseUrl}}/api/libros/[ID_DEL_LIBRO]

### 5. Actualizar un libro
PUT {{baseUrl}}/api/libros/[ID_DEL_LIBRO]
Content-Type: application/json

{
  "precio": 24.99,
  "año": 1968
}

### 6. Eliminar un libro
DELETE {{baseUrl}}/api/libros/[ID_DEL_LIBRO]

### 7. Probar validación (falta el título)
POST {{baseUrl}}/api/libros
Content-Type: application/json

{
  "autor": "Autor sin título",
  "precio": 15.99
}
```

#### **Paso 6: Ejecutar con Docker**

```bash
# Construir e iniciar contenedores
docker-compose up -d

# Ver logs
docker-compose logs -f api

# Ver logs de MongoDB
docker-compose logs -f mongodb

# Ejecutar comandos en la API
docker-compose exec api npm start

# Acceder a MongoDB
docker-compose exec mongodb mongosh -u admin -p password123 --authenticationDatabase admin

# En MongoDB shell:
# use biblioteca_api
# db.libros.find().pretty()
```

#### **Paso 7: Probar Persistencia de Datos**

```bash
# 1. Crear un libro (via REST Client)
# GET http://localhost:3000/api/libros (debe haber libros)

# 2. Detener contenedores sin eliminar volúmenes
docker-compose down

# 3. Reiniciar
docker-compose up -d

# 4. Verificar que los datos siguen existiendo
# GET http://localhost:3000/api/libros (los libros deben estar)

# ✅ Éxito: Los datos persistieron
```

### 6.3 Checklist Final

- [ ] API responde en http://localhost:3000
- [ ] MongoDB está contenedorizado y corriendo
- [ ] Las peticiones GET devuelven libros
- [ ] Las peticiones POST crean libros nuevos
- [ ] Las peticiones PUT actualizan libros
- [ ] Las peticiones DELETE eliminan libros
- [ ] Los datos persisten tras reiniciar contenedores
- [ ] Las validaciones funcionan (campos requeridos)
- [ ] Los errores se manejan correctamente
- [ ] Puedes acceder a MongoDB shell desde Docker

### 6.4 Desafíos Adicionales (Opcional)

1. **Agregar Validación de Email**
   - Crear colección de `usuarios` con email
   - Validar formato de email en el controller

2. **Implementar Paginación**
   - Parámetros `?page=1&limit=10`
   - Usar `.skip()` y `.limit()` en MongoDB

3. **Agregar Búsqueda**
   - Parámetro `?search=Quijote`
   - Buscar en títulos y autores

4. **Crear volumen de backup**
   - Exportar datos MongoDB
   - Mapear volumen para backups

5. **Implementar autenticación JWT**
   - Middleware de autenticación
   - Rutas protegidas

---

## Resumen

| Aspecto | Descripción |
|--------|------------|
| **Estructura** | bin/, routes/, controllers/, models/, config/, middleware/, public/ |
| **MongoDB Nativo** | `require('mongodb')`, sin Mongoose, control total |
| **Docker** | Dockerfile + docker-compose.yml para orquestación |
| **Volúmenes** | `mongodb_data:/data/db` para persistencia |
| **Validación** | Métodos estáticos en modelos |
| **Error Handling** | Try-catch en controllers |
| **REST Client** | Archivo `.http` para pruebas sin Postman |

**Próximos pasos:** Agregar autenticación, paginación, validación avanzada y desplegar en producción.
