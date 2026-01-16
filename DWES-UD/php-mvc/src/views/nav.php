<hr/>
<nav>
    Menú de navegación: 
    <a href='index.php'>Home</a>
    <a href='index.php?controller=LibrosController&action=mostrarListaLibros'>Libros</a>
    <a href='index.php?controller=AutoresController&action=mostrarListaAutores'>Autores</a>
    <?php
        if (Seguridad::haySesion()) {
            echo "<a href='index.php?controller=UsuariosController&action=cerrarSesion'>Cerrar sesión</a>";
        }
    ?>
</nav>
<hr/>