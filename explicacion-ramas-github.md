# Cómo usar ramas en tu repositorio personal de GitHub

Aunque trabajes solo, el uso de ramas en GitHub te permite:

- **Organizar mejor tus proyectos**: Puedes tener ramas para diferentes tecnologías (JS, PHP, Java, etc.) o para nuevas funcionalidades.
- **Evitar errores**: Si pruebas algo nuevo, lo haces en una rama y no en el código principal (main/master).
- **Trabajar desde distintos ordenadores**: Puedes subir tus cambios y descargarlos donde estés (en casa, en el centro educativo, etc.).
- **Aprender buenas prácticas**: Las ramas son esenciales cuando trabajes en equipo en el futuro.

## Conceptos básicos

- **Repositorio (repo):** Es el espacio en GitHub donde guardas tu proyecto.
- **Rama (branch):** Una versión alternativa del proyecto. Por defecto, tu código está en la rama `main` o `master`.
- **Commit:** Un conjunto de cambios guardados en una rama.
- **Push:** Subir cambios desde tu ordenador a GitHub.
- **Pull:** Descargar cambios de GitHub a tu ordenador.
- **Merge:** Unir los cambios de una rama a otra.

## Ejemplo de flujo de trabajo usando ramas

### 1. Crear una rama para una nueva funcionalidad

Por ejemplo, quieres probar un nuevo script en JavaScript:

```bash
git checkout -b js-nueva-funcionalidad
```

Ahora estás en la rama `js-nueva-funcionalidad`.

### 2. Trabaja en tus archivos

Edita, crea o elimina archivos (HTML, CSS, JS, PHP, etc.) como quieras.

### 3. Haz commit de tus cambios

```bash
git add .
git commit -m "Añadido script JS para nueva funcionalidad"
```

### 4. Sube tus cambios a GitHub (push)

```bash
git push origin js-nueva-funcionalidad
```

### 5. Si quieres unir los cambios a la rama principal (main/master)

1. Ve a GitHub y haz un **Pull Request** desde la rama `js-nueva-funcionalidad` a `main`.
2. Revisa los cambios y haz el **merge**.

### 6. Descargar el repositorio en otro ordenador (pull)

En el otro ordenador:

```bash
git clone https://github.com/mikelnavarro/tu-repo.git
# o si ya lo tienes
git pull
```
Puedes cambiar entre ramas:

```bash
git checkout js-nueva-funcionalidad
```

## Permisos y colaboración

Aunque trabajes solo, puedes configurar permisos en GitHub si en el futuro quieres colaborar con otros. Por defecto, tú eres el propietario y tienes todos los permisos para crear, borrar, fusionar ramas, etc.

## Consejos

- Usa una rama distinta para cada nueva funcionalidad o tecnología que estés aprendiendo.
- Haz commits frecuentes con mensajes claros.
- Cuando una funcionalidad esté lista y probada, únela (merge) con la rama principal.
- Borra ramas que ya no uses para mantener el repositorio limpio.
- Aprovecha GitHub para tener tus archivos siempre disponibles en la nube.

---

**¡Así aprovechas al máximo GitHub, aunque trabajes solo! Si tienes más dudas sobre comandos o flujos de trabajo, ¡pregunta!**