<?php
    require_once 'php/metodos.php';
	$conexion = conexion();
	
	$codigo = $_REQUEST['id'];
	$query = mysql_query("DELETE FROM productos_1 WHERE codigo = '$codigo'");

	mysql_close($conexion);
	
	header("Location: articulos.php?borrado=$query");
	
?>