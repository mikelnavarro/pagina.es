# Construcción de una API con Node.js y Express

## Introducción
Node.js es un entorno de ejecución de JavaScript del lado del servidor que permite construir aplicaciones web escalables. Express.js es un framework minimalista para Node.js que facilita la creación de APIs RESTful.

Esta guía explica paso a paso cómo construir una API básica, con comandos útiles y una explicación del funcionamiento de la API 'creacion-api' montada en este proyecto.

## Requisitos Previos
- **Node.js instalado**: Descárgalo desde [nodejs.org](https://nodejs.org/). Verifica con `node -v`.
- **npm**: Viene incluido con Node.js. Verifica con `npm -v`.

## Pasos para Construir una API Básica

### 1. Inicializar el Proyecto
Crea una carpeta para tu proyecto y navega a ella:
```bash
mkdir mi-api
cd mi-api
```

Inicializa el proyecto con npm (crea `package.json`):
```bash
npm init -y
```

### 2. Instalar Dependencias
Instala Express y otras librerías útiles:
```bash
npm install express morgan
```
- `express`: Framework para el servidor.
- `morgan`: Middleware para logging de solicitudes HTTP (útil para desarrollo).

### 3. Crear el Archivo Principal del Servidor (`app.js`)
Crea `app.js` en la raíz del proyecto:
```javascript
const express = require('express');
const morgan = require('morgan');
const app = express();
const PORT = 3000;

// Middleware
app.use(express.json());  // Para parsear JSON en solicitudes
app.use(express.static('public'));  // Servir archivos estáticos
app.use(morgan('dev'));  // Logging

// Ruta de prueba
app.get('/', (req, res) => {
  res.send('Bienvenido a la API');
});

// Importar rutas (ver paso 4)
const librosRouter = require('./routes/libros');
app.use('/api/libros', librosRouter);

// Iniciar servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
```

### 4. Crear Rutas (Routes)
Crea una carpeta `routes` y un archivo `libros.js`:
```javascript
const express = require('express');
const router = express.Router();

// Datos simulados (en producción, usa una base de datos)
let libros = [
  { id: 1, titulo: 'Cien años de soledad', autor: 'Gabriel García Márquez' },
  { id: 2, titulo: 'El Quijote', autor: 'Miguel de Cervantes' }
];

// GET: Obtener todos los libros
router.get('/', (req, res) => {
  res.json(libros);
});

// GET: Obtener un libro por ID
router.get('/:id', (req, res) => {
  const libro = libros.find(l => l.id == req.params.id);
  libro ? res.json(libro) : res.status(404).json({ mensaje: 'Libro no encontrado' });
});

module.exports = router;
```

### 5. Crear Archivos Estáticos (Frontend Básico)
Crea una carpeta `public` con `index.html` y una subcarpeta `js` con `script.js`.

**index.html**:
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Libros</title>
    <script src="js/script.js" defer></script>
</head>
<body>
    <h1>📚 Catálogo de Libros</h1>
    <ul id="lista-libros"></ul>
</body>
</html>
```

**script.js**:
```javascript
const lista = document.getElementById("lista-libros");

async function cargarLibros() {
  try {
    const response = await fetch("/api/libros");
    if (!response.ok) throw new Error("Error en la API");
    const data = await response.json();
    mostrarDom(data);
  } catch (error) {
    console.error("Error:", error);
  }
}

function mostrarDom(data) {
  data.forEach(libro => {
    const li = document.createElement("li");
    li.textContent = `${libro.id} - ${libro.titulo} (${libro.autor})`;
    lista.appendChild(li);
  });
}

cargarLibros();
```

### 6. Ejecutar la API
Inicia el servidor:
```bash
node app.js
```
Abre `http://localhost:3000` en el navegador para ver el frontend.

## Comandos Útiles
- `npm start`: Si configuras `"start": "node app.js"` en `package.json`.
- `npm install <paquete>`: Instalar dependencias.
- `npm list`: Ver dependencias instaladas.
- `node --version`: Ver versión de Node.js.
- `curl http://localhost:3000/api/libros`: Probar la API desde terminal.
- Para desarrollo: Instala `nodemon` (`npm install -g nodemon`) y usa `nodemon app.js` para reinicio automático.

## Funcionamiento de la API 'creacion-api'
Esta API es un catálogo de libros simple, montada con Node.js y Express.

### Estructura de Archivos
- `app.js`: Servidor principal. Configura Express, middleware (Morgan para logs, static para archivos públicos), rutas y arranca en puerto 3000.
- `routes/libros.js`: Maneja rutas relacionadas con libros. Usa datos simulados (array `libros`). Rutas:
  - `GET /api/libros`: Devuelve todos los libros en JSON.
  - `GET /api/libros/:id`: Devuelve un libro específico por ID.
- `public/index.html`: Página HTML básica con un `<ul>` para listar libros y un input (aunque no funcional aún).
- `public/js/script.js`: JavaScript que consume la API. Al cargar la página, hace `fetch` a `/api/libros`, parsea JSON y actualiza el DOM creando `<li>` para cada libro.

### Flujo de Funcionamiento
1. El servidor inicia y sirve archivos estáticos desde `public`.
2. Al acceder a `http://localhost:3000`, se carga `index.html`.
3. `script.js` ejecuta `cargarLibros()`, que hace una petición GET a `/api/libros`.
4. El servidor responde con el array de libros en JSON.
5. El frontend renderiza la lista en el `<ul>`.

### Mejoras Posibles
- Conectar a una base de datos (e.g., MongoDB).
- Añadir rutas POST/PUT/DELETE para CRUD completo.
- Implementar búsqueda en el input de `index.html`.
- Manejo de errores más robusto y autenticación.

Esta API es un punto de partida accesible para aprender desarrollo backend con Node.js.</content>
<parameter name="filePath">d:\xampp\htdocs\pagina.es\creacion-api\explicacion_api.md
