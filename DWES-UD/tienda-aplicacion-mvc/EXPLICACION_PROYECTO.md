# 🏪 Proyecto: Tienda para Restaurantes

## 📋 Descripción General
Aplicación web PHP basada en MVC que permite a los restaurantes gestionar un sistema de compra de productos para restaurantes. Los usuarios pueden seleccionar productos por categorías, añadirlos al carrito y ver el resumen de compra.

---

## 🏗️ Estructura del Proyecto

### 📁 Directorios principales:

```
tienda-aplicacion/
├── public/              # Archivos accesibles desde el navegador
│   ├── index.php       # Página principal - muestra categorías
│   ├── productos.php   # Listado de productos por categoría
│   ├── add_carrito.php # Procesa el añadido de productos al carrito
│   ├── carrito.php     # Muestra el carrito de compras
│   ├── cabecera.php    # Header con datos del usuario
│   ├── login.php       # Formulario de login
│   ├── logout.php      # Cierra la sesión
│   ├── perfil_usu.php  # Perfil del usuario
│   └── assets/         # CSS e imágenes
│
├── src/                # Clases PHP (namespace: Mikelnavarro\TiendaAplicacion)
│   ├── Producto.php    # Modelo de Producto
│   ├── Categoria.php   # Modelo de Categoría
│   └── Usuario.php     # Modelo de Usuario
│
├── tools/              # Utilidades
│   ├── Conexion.php    # Conexión a BD
│   ├── Config.php      # Configuración
│   ├── Validador.php   # Validaciones
│   └── Mailer.php      # Envío de emails
│
├── db/                 # Scripts SQL
│   ├── tienda.sql      # Base de datos principal
│   └── restaurante.sql # Alternativa
│
├── vendor/             # Dependencias (composer)
└── composer.json       # Configuración de dependencias
```

---

## 🔄 Flujo de la Aplicación

### 1️⃣ **Inicio (index.php)**
- Muestra todas las categorías disponibles en la BD
- El usuario selecciona una categoría para ver los productos

### 2️⃣ **Listado de Productos (productos.php)**
- Recibe el parámetro `?categoria=X`
- Muestra todos los productos de esa categoría
- Cada producto tiene un formulario para seleccionar cantidad y añadir al carrito

### 3️⃣ **Añadir al Carrito (add_carrito.php)**
- Recibe POST con `id` (código del producto) y `cantidad`
- Si el producto ya está en el carrito, suma la cantidad
- Si es nuevo, lo inserta con sus datos (nombre, precio, peso, cantidad)
- Guarda en `$_SESSION['carrito']`
- Redirige a `carrito.php`

### 4️⃣ **Ver Carrito (carrito.php)**
- Muestra la tabla con los productos añadidos
- Calcula subtotales (Precio × Cantidad)
- Muestra el total de la compra

---

## 🐛 PROBLEMAS IDENTIFICADOS Y SOLUCIÓN

### ❌ PROBLEMA 1: El precio no se guarda correctamente en el carrito

**Archivo:** [add_carrito.php](add_carrito.php#L24)

**Error en línea 24:**
```php
'Precio' => $precio['Precio'],  // ❌ Variable incorrecta: $precio
```

**Corrección:**
```php
'Precio' => $producto['Precio'],  // ✅ Debe ser $producto, no $precio
```

**Explicación:** Se está intentando acceder a `$precio['Precio']` pero la variable se llama `$producto`. Esto genera un Notice/Warning y el precio queda vacío.

---

### ❌ PROBLEMA 2: No aparece la cabecera después de añadir al carrito

**Archivo:** [carrito.php](carrito.php)

**Problema:** El archivo `carrito.php` NO incluye `cabecera.php` como lo hace `productos.php`. La cabecera con navegación y datos del usuario está definida en `cabecera.php` pero no se está cargando en carrito.php.

**Solución:** Añadir la cabecera y el navbar en `carrito.php` para poder navegar entre categorías y volver a la página de productos.

---

## 💻 Clases Principales

### **Producto.php**
- `productosPorCategoria($categoria)` → Obtiene productos de una categoría
- `buscarPorId($codProd)` → Obtiene un producto por su ID
- Guarda: CodProd, Nombre, Descripcion, Peso, Stock, Categoría

### **Categoria.php**
- `todas()` → Obtiene todas las categorías
- Propiedades: CodCat, NombreCat

### **Usuario.php**
- Gestiona datos del usuario logueado
- Propiedades: CodRes (código restaurante), Correo

### **Conexion.php**
- `getConexion()` → Retorna conexión PDO a la BD
- Lee la configuración de `config/config.ini`

---

## 🗄️ Base de Datos

### Tabla: **productos**
```sql
- CodProd (INT) - Clave primaria
- Nombre (VARCHAR)
- Descripcion (TEXT)
- Precio (DECIMAL)
- Peso (DECIMAL)
- Stock (INT)
- categoria (INT) - FK a categorías
```

### Tabla: **categorias**
```sql
- CodCat (INT) - Clave primaria
- NombreCat (VARCHAR)
```

### Tabla: **usuarios**
```sql
- CodRes (INT) - Clave primaria (código restaurante)
- correo (VARCHAR)
- contraseña (VARCHAR)
```

---

## 🔐 Seguridad

- ✅ Uso de `htmlspecialchars()` para prevenir XSS
- ✅ Consultas preparadas (prepared statements) con PDO
- ✅ Sesiones PHP para autenticación
- ❌ El precio se enviaba mal (ya corregido)

---

## 📝 Notas de Desarrollo

- El carrito se almacena en `$_SESSION['carrito']`
- Cada línea del carrito contiene: CodProd, Nombre, Precio, Peso, cantidad
- No hay persistencia en BD (el carrito se pierde al cerrar sesión)
- Las imágenes/activos están en `public/assets/`
