<?php

	function manejadorErrores($errno, $str, $file, $line) {
		echo "Ocurrio el error: $errno";
	}
	set_error_handler("manejadorErrores");
	$a = $b; // $b sin incicializar
?>