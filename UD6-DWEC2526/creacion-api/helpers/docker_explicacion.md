# Docker, Volúmenes y Variables de Entorno - Guía Para Windows

## Índice
1. [¿Qué es Docker?](#1-qué-es-docker)
2. [Instalación en Windows](#2-instalación-en-windows)
3. [Conceptos Clave](#3-conceptos-clave)
4. [Variables de Entorno (.env)](#4-variables-de-entorno-env)
5. [docker-compose.yml Explicado](#5-docker-composeyml-explicado)
6. [Volúmenes en Docker](#6-volúmenes-en-docker)
7. [Trabajar con Docker en Windows](#7-trabajar-con-docker-en-windows)
8. [Troubleshooting Común](#8-troubleshooting-común)

---

## 1. ¿Qué es Docker?

Docker es una **plataforma de contenerización** que empaqueta tu aplicación con todas sus dependencias (Node, MongoDB, etc.) en una "caja" portátil llamada **contenedor**.

### Sin Docker:
```
Tu máquina (Windows)
├── Node.js v18
├── MongoDB instalado
├── Tu código de API
└── Versión de librerías XYZ
```

Problema: Si cambias de máquina o alguien más lo corre, puede fallar por diferencias de versiones.

### Con Docker:
```
Contenedor (como una máquina virtual ligera)
├── Node.js v18 (fijo)
├── MongoDB (en otro contenedor)
├── Tu código de API
└── Versión de librerías XYZ (fijo)
```

Ventaja: Funciona igual en cualquier máquina (Windows, Linux, Mac).

---

## 2. Instalación en Windows

### 2.1 Descargar Docker Desktop

1. Ve a [Docker Official Website](https://www.docker.com/products/docker-desktop)
2. Descarga **Docker Desktop para Windows**
3. Ejecuta el instalador
4. Espera a que termine (puede tomar varios minutos)
5. **Reinicia tu PC**

### 2.2 Verificar Instalación

Abre **PowerShell** y ejecuta:

```powershell
docker --version
docker-compose --version
```

Deberías ver:
```
Docker version 24.0.0, build 1234567
Docker Compose version v2.20.0
```

### 2.3 Configurar Docker Desktop en Windows

1. Abre **Docker Desktop**
2. Ve a **Settings → General**
   - ✅ Asegúrate que "Expose daemon on tcp://localhost:2375" está deshabilitado (por seguridad)
3. Ve a **Settings → Resources**
   - Aumenta **CPU**: Mínimo 2 núcleos
   - Aumenta **Memory**: Mínimo 4GB
   - Aumenta **Disk Image Size**: Mínimo 30GB
4. Click en **Apply & Restart**

---

## 3. Conceptos Clave

### 3.1 Imagen vs Contenedor

| Concepto | Analogía | Ejemplo |
|----------|----------|---------|
| **Imagen** | Plano/plantilla | `node:18-alpine` |
| **Contenedor** | Casa construida del plano | Un contenedor corriendo Node.js |

```
Dockerfile (receta)
    ↓
docker build (construcción)
    ↓
Imagen (plantilla lista para usar)
    ↓
docker run (crear contenedor)
    ↓
Contenedor (aplicación corriendo)
```

### 3.2 Dockerfile - Receta para Construir Imagen

```dockerfile
# Dockerfile
# Base: Imagen oficial de Node.js en versión ligera
FROM node:18-alpine

# Directorio de trabajo dentro del contenedor
WORKDIR /app

# Copiar package.json y package-lock.json
COPY package*.json ./

# Instalar dependencias
RUN npm install

# Copiar todo el código
COPY . .

# Exponer puerto (documentación, el puerto real se mapea después)
EXPOSE 3000

# Comando para ejecutar la aplicación
CMD ["npm", "start"]
```

### 3.3 Docker vs Docker Compose

| Herramienta | Uso | Comando |
|------------|-----|---------|
| **Docker** | Ejecutar UN contenedor | `docker run -p 3000:3000 mi-app` |
| **Docker Compose** | Ejecutar MÚLTIPLES contenedores orquestados | `docker-compose up` |

**En nuestro caso:**
- Necesitamos 2 contenedores: API (Node.js) + MongoDB
- Docker Compose orquesta ambos automáticamente

---

## 4. Variables de Entorno (.env)

Las variables de entorno son configuraciones que cambian según el ambiente (desarrollo, producción, etc.).

### 4.1 ¿Por Qué Necesitamos .env?

**Malo (hardcodeado):**
```javascript
const MONGO_URL = "mongodb://admin:password123@localhost:27017/biblioteca";
const API_KEY = "mi-clave-secreta-super-importante";
```
Problemas:
- ❌ La contraseña está visible en el código
- ❌ Si cambio de máquina, debo editar el código
- ❌ Riesgo de compartir secrets en GitHub

**Bueno (con .env):**
```javascript
const MONGO_URL = process.env.MONGO_URL;
const API_KEY = process.env.API_KEY;
```

### 4.2 Crear archivo .env

En la raíz de tu proyecto (`creacion-api/`):

```env
# .env
# Puerto de la aplicación
PORT=3000

# URL de conexión a MongoDB
MONGO_URL=mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin

# Nombre de la base de datos
DB_NAME=biblioteca_api

# Ambiente (development/production)
NODE_ENV=development

# Credenciales MongoDB (se usan en docker-compose.yml)
MONGO_INITDB_ROOT_USERNAME=admin
MONGO_INITDB_ROOT_PASSWORD=password123
MONGO_INITDB_DATABASE=biblioteca_api
```

### 4.3 Usar Variables en app.js

```javascript
// app.js
require('dotenv').config();  // Cargar .env

const PORT = process.env.PORT || 3000;
const NODE_ENV = process.env.NODE_ENV || 'development';

console.log(`Ejecutando en ${NODE_ENV}`);
console.log(`Puerto: ${PORT}`);
```

### 4.4 Archivos .env Diferentes

En producción, usarías otro archivo:

```
.env                  # Desarrollo local
.env.production       # Producción
.env.test             # Testing
.gitignore            # Ignorar .env en Git (por seguridad)
```

**Contenido .gitignore:**
```
node_modules/
.env
.env.local
*.log
.DS_Store
```

---

## 5. docker-compose.yml Explicado

El archivo `docker-compose.yml` orquesta múltiples contenedores. Vamos línea por línea.

### 5.1 Estructura Básica

```yaml
version: '3.8'              # Versión de sintaxis de Docker Compose

services:                   # Definición de servicios (contenedores)
  mongodb:                  # Nombre del servicio (referencia interna)
    # ... configuración ...

  api:                      # Otro servicio
    # ... configuración ...

volumes:                    # Volúmenes nombrados (persistencia)
  mongodb_data:
    driver: local

networks:                   # Redes para comunicar servicios
  api-network:
    driver: bridge
```

### 5.2 Servicio MongoDB Explicado Línea por Línea

```yaml
services:
  mongodb:
    # Imagen oficial de MongoDB versión 6
    image: mongo:6
    
    # Nombre del contenedor (cómo lo ves en Docker Desktop)
    container_name: mongodb-biblioteca
    
    # Mapeo de puertos: HOST:CONTENEDOR
    # 27017 es el puerto por defecto de MongoDB
    ports:
      - "27017:27017"
    
    # Variables de entorno dentro del contenedor
    environment:
      # Usuario root de MongoDB
      MONGO_INITDB_ROOT_USERNAME: admin
      # Contraseña del usuario root
      MONGO_INITDB_ROOT_PASSWORD: password123
      # Base de datos inicial
      MONGO_INITDB_DATABASE: biblioteca_api
    
    # Volúmenes: Dónde persisten los datos
    # mongodb_data es el nombre del volumen (se define abajo)
    # /data/db es el directorio dentro del contenedor donde MongoDB guarda datos
    volumes:
      - mongodb_data:/data/db
      - mongodb_config:/data/configdb
    
    # Red a la que conectar (permite que otros servicios se comuniquen)
    networks:
      - api-network
    
    # Verificar que MongoDB está listo antes de iniciar otros servicios
    healthcheck:
      # Comando para verificar si MongoDB responde
      test: ["CMD", "mongosh", "--eval", "db.adminCommand('ping')"]
      # Cada cuántos segundos verificar
      interval: 10s
      # Cuánto esperar para considerar que falló
      timeout: 5s
      # Cuántas veces reintentar
      retries: 5
```

### 5.3 Servicio API Explicado Línea por Línea

```yaml
  api:
    # Construir imagen desde Dockerfile
    build:
      context: .                    # Directorio donde está el Dockerfile
      dockerfile: Dockerfile         # Nombre del Dockerfile
    
    # Nombre del contenedor
    container_name: api-biblioteca
    
    # Puertos: HOST:CONTENEDOR
    # Accedes desde Windows en localhost:3000
    ports:
      - "3000:3000"
    
    # Variables de entorno (se cargan en .env de la app)
    environment:
      # URL de conexión a MongoDB
      # "mongodb" es el nombre del servicio (Docker lo resuelve internamente)
      MONGO_URL: mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin
      DB_NAME: biblioteca_api
      NODE_ENV: production
    
    # Dependencias: No iniciar hasta que MongoDB esté healthy
    depends_on:
      mongodb:
        # Esperar a que healthcheck pase
        condition: service_healthy
    
    # Volúmenes para desarrollo
    volumes:
      # Sincronizar código actual con /app del contenedor
      # Permite editar código y verlo reflejado sin reconstruir
      - ./:/app
      # Excluir node_modules del mapeo (usa los del contenedor)
      - /app/node_modules
    
    # Red (la misma que MongoDB para comunicarse)
    networks:
      - api-network
    
    # Comando a ejecutar al iniciar el contenedor
    command: npm start
```

### 5.4 Volúmenes y Redes Explicados

```yaml
# Volúmenes nombrados (persistencia de datos)
volumes:
  # Volumen para datos de MongoDB
  mongodb_data:
    driver: local                    # Driver local (en tu máquina)
  
  # Volumen para configuración de MongoDB
  mongodb_config:
    driver: local

# Redes (permiten comunicación entre servicios)
networks:
  # Red bridge: Aísla los contenedores pero permite comunicación
  api-network:
    driver: bridge
```

---

## 6. Volúmenes en Docker

Los **volúmenes** aseguran que los datos NO se pierdan cuando eliminas un contenedor.

### 6.1 Tipos de Volúmenes

#### Volumen Nombrado (Recomendado)

```yaml
volumes:
  mongodb_data:
    driver: local
```

**Dónde se guardan en Windows:**
```
C:\Users\TuUsuario\AppData\Local\Docker\wsl\data\
```

Ventajas:
- ✅ Gestionado por Docker
- ✅ Independiente del código
- ✅ Funciona igual en cualquier SO
- ✅ Fácil de hacer backup

#### Bind Mount (Mapeo Directo)

```yaml
volumes:
  - ./data:/data/db        # ./data en Windows → /data/db en contenedor
```

Ventajas:
- ✅ Ves los archivos en tu PC
- ✅ Útil para desarrollo

Desventajas:
- ❌ Problemas de permisos en Windows
- ❌ Rendimiento más lento

### 6.2 Cómo Funciona la Persistencia

```
PASO 1: Iniciar contenedores
┌─────────────────────┐
│   docker-compose up │
└─────────────────────┘
           ↓
    Se crea volumen: mongodb_data
           ↓
    MongoDB guarda datos ahí
           ↓
    Creas un libro: "El Quijote"

PASO 2: Detener (sin eliminar volumen)
┌─────────────────────────┐
│   docker-compose stop   │
└─────────────────────────┘
           ↓
    Contenedores se detienen
           ↓
    ¡PERO el volumen sigue existiendo!
           ↓
    El libro sigue en mongodb_data

PASO 3: Reiniciar
┌─────────────────────┐
│   docker-compose up │
└─────────────────────┘
           ↓
    MongoDB se monta en el volumen existente
           ↓
    ¡El libro sigue ahí! ✅
```

### 6.3 Comandos de Volúmenes en PowerShell

```powershell
# Ver todos los volúmenes creados
docker volume ls

# Ver información detallada de un volumen
docker volume inspect mongodb_data

# Ver dónde está guardado (en Windows es virtual)
docker volume inspect mongodb_data | Select-Object -Property Mountpoint

# Eliminar un volumen (¡CUIDADO! Borra los datos)
docker volume rm mongodb_data

# Eliminar todos los volúmenes no usados
docker volume prune
```

### 6.4 Ejemplo Práctico: Guardar y Recuperar Datos

**Terminal 1: Crear y llenar de datos**
```powershell
# Iniciar contenedores
docker-compose up -d

# Esperar a que esté listo (10 segundos)
Start-Sleep -Seconds 10

# Crear un libro via REST Client (o curl)
# POST http://localhost:3000/api/libros
# {
#   "titulo": "Mi Libro Importante",
#   "autor": "Yo Mismo"
# }
```

**Terminal 2: Verificar que está en el volumen**
```powershell
# Acceder a MongoDB shell
docker-compose exec mongodb mongosh -u admin -p password123 --authenticationDatabase admin

# Dentro de MongoDB:
# use biblioteca_api
# db.libros.find().pretty()
# 
# Deberías ver tu libro
```

**Terminal 3: Simular pérdida y recuperación**
```powershell
# Detener sin eliminar volumen
docker-compose stop

# Los datos están SEGUROS en el volumen
# Verificar con:
docker volume ls
# Deberías ver: mongodb_data

# Reiniciar
docker-compose up -d

# Verificar que el libro sigue:
# GET http://localhost:3000/api/libros
# ¡Tu libro está aquí! ✅
```

---

## 7. Trabajar con Docker en Windows

### 7.1 Estructura de Carpetas Recomendada

```
D:\xampp\htdocs\pagina.es\creacion-api\
├── app.js                    # Aplicación principal
├── package.json              # Dependencias
├── .env                      # Variables de entorno
├── .gitignore                # Archivos a ignorar
├── docker-compose.yml        # Orquestación de contenedores
├── Dockerfile                # Receta de imagen (opcional aquí)
├── docker/                   # (Opcional) Archivos Docker
│   ├── Dockerfile
│   └── .dockerignore
├── config/
│   └── db.js                 # Conexión a MongoDB
├── routes/
│   └── libros.js
├── controllers/
│   └── librosController.js
├── models/
│   └── Libro.js
└── public/
    ├── index.html
    ├── css/
    └── js/
```

### 7.2 Flujo Completo en PowerShell

```powershell
# 1. Navegar a tu proyecto
cd D:\xampp\htdocs\pagina.es\creacion-api

# 2. Crear archivo .env (si no existe)
# Contenido:
# PORT=3000
# MONGO_URL=mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin
# DB_NAME=biblioteca_api
# NODE_ENV=development

# 3. Construir imagen (primera vez)
docker-compose build

# 4. Iniciar contenedores en segundo plano
docker-compose up -d

# 5. Ver que están corriendo
docker ps

# Salida esperada:
# CONTAINER ID   IMAGE           PORTS                    NAMES
# abc123...      my-app:latest   0.0.0.0:3000->3000/tcp  api-biblioteca
# def456...      mongo:6         0.0.0.0:27017->27017    mongodb-biblioteca

# 6. Ver logs de la API
docker-compose logs -f api

# 7. Ver logs de MongoDB
docker-compose logs -f mongodb

# 8. Ejecutar comando en el contenedor
docker-compose exec api npm list

# 9. Acceder a MongoDB shell
docker-compose exec mongodb mongosh -u admin -p password123 --authenticationDatabase admin

# 10. Detener contenedores
docker-compose down

# 11. Detener y ELIMINAR volúmenes (¡cuidado!)
docker-compose down -v
```

### 7.3 Mapeo de Puertos en Windows

Cuando ejecutas:
```yaml
ports:
  - "3000:3000"
  - "27017:27017"
```

| Puerto Windows (Host) | Puerto Contenedor | Acceso |
|----------------------|------------------|--------|
| 3000 | 3000 (Node.js) | http://localhost:3000 |
| 27017 | 27017 (MongoDB) | mongodb://localhost:27017 |

**Desde tu PC:**
```powershell
# Probar que API responde
curl http://localhost:3000

# Conectar a MongoDB local
# Usar cualquier cliente de MongoDB con: mongodb://localhost:27017
```

---

## 8. Troubleshooting Común

### 8.1 "Docker no está corriendo"

**Error:**
```
error during connect: This error may indicate that the docker daemon is not running
```

**Solución:**
1. Abre **Docker Desktop**
2. Espera a que el icono sea azul (está listo)
3. Intenta de nuevo

### 8.2 "Puerto 3000 ya está en uso"

**Error:**
```
Error response from daemon: Ports are not available
```

**Solución opción 1: Cambiar puerto en docker-compose.yml**
```yaml
ports:
  - "3001:3000"  # Usar 3001 en lugar de 3000
```

**Solución opción 2: Encontrar y matar proceso**
```powershell
# Ver qué está usando puerto 3000
netstat -ano | findstr :3000

# Matar el proceso (reemplaza PID)
taskkill /PID 12345 /F
```

### 8.3 "MongoDB no responde"

**Error:**
```
mongodb exited with code 1
```

**Solución:**
```powershell
# Ver logs
docker-compose logs mongodb

# Reconstruir
docker-compose down -v
docker-compose build
docker-compose up -d
```

### 8.4 "No puedo conectar a MongoDB desde la API"

**Problema:** La API intenta conectar a `localhost` en lugar de `mongodb`

**Solución:** En la variable de entorno `MONGO_URL` usa el nombre del servicio:
```env
# ❌ Incorrecto
MONGO_URL=mongodb://localhost:27017/biblioteca_api

# ✅ Correcto (dentro de Docker)
MONGO_URL=mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin
```

### 8.5 "Los datos desaparecieron después de docker-compose down -v"

**Explicación:** El flag `-v` elimina volúmenes

**Solución:** No usar `-v` a menos que quieras perder datos
```powershell
# ❌ Elimina volúmenes
docker-compose down -v

# ✅ Solo detiene, mantiene volúmenes
docker-compose down
```

### 8.6 "Permiso denegado en Windows"

**Error:**
```
permission denied while trying to connect to Docker daemon
```

**Solución:** Ejecutar PowerShell como **Administrador**

---

## Resumen Visual Completo

```
┌─────────────────────────────────────────────────────────┐
│         Tu Máquina Windows                              │
│                                                         │
│  Puerto 3000          Puerto 27017                      │
│      ↓                    ↓                              │
│  localhost:3000       localhost:27017                   │
│      ↓                    ↓                              │
│  ┌──────────────────────────────────────┐               │
│  │  Docker Desktop (Motor de Docker)    │               │
│  │                                      │               │
│  │  ┌─────────────────┐  ┌────────────┐ │               │
│  │  │  Contenedor API │  │ Contenedor │ │               │
│  │  │                 │  │  MongoDB   │ │               │
│  │  │ Node.js 18      │  │ Mongo 6    │ │               │
│  │  │ Express         │  │            │ │               │
│  │  │ Tu código       │  │ /data/db   │ │               │
│  │  │ Puerto 3000     │  │ Puerto 27017 │ │               │
│  │  └────────┬────────┘  └────────┬───┘ │               │
│  │           │                    │     │               │
│  │   Volumen: ./:/app    Volumen: mongodb_data          │
│  │   (Código sincronizado) (Datos persistentes)         │
│  │                                      │               │
│  │           Red: api-network           │               │
│  │           (Comunica los servicios)   │               │
│  │                                      │               │
│  └──────────────────────────────────────┘               │
│                                                         │
│  .env                 docker-compose.yml                │
│  ├─ PORT=3000         ├─ API: 3000:3000                 │
│  ├─ MONGO_URL=...     ├─ MongoDB: 27017:27017          │
│  └─ DB_NAME=...       └─ Volúmenes + Redes             │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

---

## Checklist: Antes de Ejecutar docker-compose up

- [ ] Docker Desktop está instalado y ejecutándose (icono azul)
- [ ] PowerShell está en la carpeta del proyecto (`creacion-api/`)
- [ ] Existe archivo `.env` con variables correctas
- [ ] Existe `docker-compose.yml` con configuración correcta
- [ ] Existe `Dockerfile` o está en carpeta `docker/`
- [ ] No hay otros servicios usando puertos 3000 y 27017
- [ ] `package.json` tiene script `"start": "node app.js"`

---

## Comandos Rápidos para Copiar y Pegar

```powershell
# Iniciar
docker-compose up -d

# Ver estado
docker ps

# Ver logs
docker-compose logs -f api

# Acceder a MongoDB
docker-compose exec mongodb mongosh -u admin -p password123 --authenticationDatabase admin

# Detener
docker-compose down

# Reconstruir completamente
docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
```

---

## 9. Iniciar la API: Local vs Docker

Esta es una pregunta clave: **¿Debo hacer `npm start` en mi máquina o usar `docker-compose up`?**

La respuesta depende de si quieres usar Docker o no. Veamos ambas opciones.

### 9.1 Opción 1: Iniciar API en LOCAL (Sin Docker)

**Cuándo usar:**
- Desarrollo rápido y fácil
- No necesitas MongoDB (o lo tienes instalado localmente)
- Quieres máximo control

**Pasos:**

```powershell
# 1. Navegar a la carpeta del proyecto
cd D:\xampp\htdocs\pagina.es\creacion-api

# 2. Instalar dependencias (primera vez)
npm install

# 3. Iniciar la API
npm start

# Resultado esperado:
# ✅ Servidor en http://localhost:3000
# ✅ Conectado a MongoDB (si está instalado)
```

**Configuración necesaria en .env:**
```env
PORT=3000
MONGO_URL=mongodb://localhost:27017/biblioteca_api
DB_NAME=biblioteca_api
NODE_ENV=development
```

**Problema:** MongoDB debe estar corriendo en tu máquina (no con Docker)

```powershell
# Si NO tienes MongoDB instalado localmente:
# Error: connect ECONNREFUSED 127.0.0.1:27017
```

### 9.2 Opción 2: Iniciar API en DOCKER (Recomendado para Clase)

**Cuándo usar:**
- Desarrollo con Docker (como en clase)
- Quieres MongoDB en contenedor
- Necesitas reproducibilidad exacta
- Usas volúmenes para desarrollo en vivo

**Pasos:**

```powershell
# 1. Navegar a la carpeta del proyecto
cd D:\xampp\htdocs\pagina.es\creacion-api

# 2. Iniciar contenedores (INCLUYE MongoDB + API)
docker-compose up -d

# 3. Ver que está corriendo
docker ps

# 4. Ver logs
docker-compose logs -f api

# Resultado esperado:
# ✅ Servidor en http://localhost:3000
# ✅ MongoDB en http://localhost:27017
# ✅ Ambos en contenedores
```

**Configuración en .env:**
```env
PORT=3000
MONGO_URL=mongodb://admin:password123@mongodb:27017/biblioteca_api?authSource=admin
DB_NAME=biblioteca_api
NODE_ENV=development
```

**Ventaja:** MongoDB ya está en contenedor, no necesitas instalarlo

### 9.3 Comparativa Completa

| Aspecto | LOCAL (npm start) | DOCKER (docker-compose up) |
|--------|------------------|--------------------------|
| **Inicio** | `npm start` | `docker-compose up -d` |
| **MongoDB** | Instalado en Windows | En contenedor MongoDB |
| **Puerto API** | localhost:3000 | localhost:3000 |
| **Puerto MongoDB** | localhost:27017 | localhost:27017 |
| **Editar código** | Cambios instantáneos | Cambios instantáneos (volumen) |
| **Reconstruir** | Restart Node | Restart contenedor |
| **Complejidad** | Más simple | Más poderosa |
| **Reproducibilidad** | Depende del SO | Garantizado (contenedor) |

### 9.4 ¿Cómo Funciona el Volumen en Docker?

El **volumen** es la clave para desarrollo en vivo en Docker.

**Sin volumen (no recomendado):**
```yaml
# Código está DENTRO del contenedor
# Editas archivo en Windows
# El contenedor NO lo ve
# Necesitas reconstruir imagen (lento)
```

**Con volumen (recomendado):**
```yaml
# docker-compose.yml
volumes:
  - ./:/app              # Sincronización en vivo
  - /app/node_modules   # Excluir node_modules
```

```
Tu máquina Windows                  Contenedor Docker
┌──────────────────┐               ┌──────────────────┐
│ creacion-api/    │ ←→ SINCRONÍA  │ /app/            │
│ ├─ app.js        │              │ ├─ app.js        │
│ ├─ routes/       │              │ ├─ routes/       │
│ └─ controllers/  │              │ └─ controllers/  │
└──────────────────┘               └──────────────────┘

Editas app.js en Windows
        ↓
Cambio aparece en /app/app.js del contenedor
        ↓
Node.js reinicia (si usas nodemon)
        ↓
Cambios en vivo ✅
```

### 9.5 Desarrollo en Vivo: Nodemon

Para que los cambios se reflejen sin reiniciar manualmente, usa **nodemon**.

**Instalar:**
```bash
npm install --save-dev nodemon
```

**Configurar en package.json:**
```json
{
  "scripts": {
    "start": "node app.js",
    "dev": "nodemon app.js"
  }
}
```

**En docker-compose.yml, cambiar comando:**
```yaml
services:
  api:
    command: npm run dev    # Usa nodemon en lugar de node
```

**Resultado:**
```powershell
docker-compose up -d

# Logs en tiempo real:
docker-compose logs -f api

# Edita un archivo en Windows
# Verás en los logs:
# [nodemon] restarting due to changes...
# Cambios reflejados instantáneamente ✅
```

### 9.6 Flujo de Desarrollo Recomendado (Con Docker)

```powershell
# INICIO DEL DÍA
docker-compose up -d

# Durante el desarrollo
# Edita archivos en tu editor (VS Code)
# Cambios se sincronizan automáticamente
# Usa REST Client (archivo api.http) para probar

# Ver logs en tiempo real
docker-compose logs -f api
docker-compose logs -f mongodb

# Si necesitas parar
docker-compose stop

# Si necesitas reiniciar
docker-compose restart api

# Al final del día
docker-compose down   # Detiene pero mantiene volúmenes y datos
```

### 9.7 Troubleshooting: Cambios NO se Reflejan

**Problema:** Edité un archivo pero la API sigue igual

**Soluciones:**

1. **Verificar que el volumen está configurado:**
```yaml
volumes:
  - ./:/app              # ✅ Correcto
  - /app/node_modules   # Excluir node_modules
```

2. **Verificar que los cambios están guardados:**
   - VS Code muestra punto blanco si hay cambios sin guardar
   - Presiona `Ctrl+S`

3. **Verificar que nodemon está instalado:**
```bash
npm list nodemon
```

4. **Reiniciar contenedor:**
```powershell
docker-compose restart api
```

5. **Reconstruir completamente:**
```powershell
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### 9.8 Decisión Final: ¿Qué Usar?

**Para esta clase (recomendado):**
```powershell
# Usa Docker
docker-compose up -d

# Desarrolla normalmente editando archivos
# El volumen cuida la sincronización
# MongoDB está en contenedor (todo incluido)
# Cambios en vivo con nodemon
```

**Ventajas:**
- ✅ Todo controlado
- ✅ Igual para todos los compañeros
- ✅ MongoDB incluido
- ✅ Preparado para producción
- ✅ Entiendes cómo funcionan contenedores

**Para prototipado rápido (alternativa):**
```powershell
# Usa npm local
npm start

# Pero necesitas MongoDB instalado localmente
# Y cambiar MONGO_URL en .env a localhost
```

---

## Conclusión

| Concepto | Explicación |
|----------|------------|
| **Docker** | Empaqueta app con todas sus dependencias |
| **.env** | Variables sensibles (contraseñas, URLs) |
| **docker-compose.yml** | Orquesta múltiples contenedores |
| **Volúmenes** | Persisten datos aunque se elimine contenedor |
| **Puertos** | Mapean exterior (Windows) → interior (contenedor) |
| **Redes** | Permiten comunicación entre contenedores |
| **Nodemon** | Hot reload automático en desarrollo |
| **npm start** | Para desarrollo local sin Docker |
| **docker-compose up** | Para desarrollo con Docker (recomendado) |

**Respuesta a la pregunta clave:** Con Docker y volumen, editas normalmente en VS Code y los cambios se reflejan instantáneamente en el contenedor (con nodemon). No necesitas hacer `npm start` en Windows, el contenedor corre la API automáticamente.

Docker es esencial en desarrollo moderno. Una vez lo domines, desplegar tu app en cualquier servidor será trivial.
