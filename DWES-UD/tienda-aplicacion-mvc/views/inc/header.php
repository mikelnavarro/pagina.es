<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<header style="background:#2c3e50;color:#fff;padding:12px 20px;display:flex;align-items:center;justify-content:space-between;">
	<div style="display:flex;align-items:center;gap:12px;">
		<a href="/" style="color:#fff;text-decoration:none;font-weight:700;font-size:18px;">Mi Tienda</a>
		<nav style="font-size:14px;">
			<a href="/Categoria/categorias" style="color:#fff;margin-right:12px;text-decoration:none;">Categorías</a>
			<a href="/Carrito/listar" style="color:#fff;margin-right:12px;text-decoration:none;">Carrito</a>
		</nav>
	</div>
	<div style="font-size:14px;">
		<?php if (!empty($_SESSION['user'])): ?>
			<span style="margin-right:12px;">Hola, <?= htmlspecialchars($_SESSION['user']) ?></span>
			<a href="/Restaurante/logout" style="color:#fff;text-decoration:none;">Cerrar sesión</a>
		<?php else: ?>
			<a href="/Restaurante/loginForm" style="color:#fff;text-decoration:none;">Entrar</a>
		<?php endif; ?>
	</div>
</header>
