<?php
	session_start();
	if (isset($_SESSION['usuario']) === TRUE) 
	{
		require_once 'php/metodos.php';
		$conexion = conexion();
		
		$nombre = $_SESSION['usuario'];
		$id = $_REQUEST['id'];	
	
		$query = mysql_query("SELECT * FROM productos_1 WHERE codigo = '$id'",$conexion);
		
		$resultado = mysql_fetch_array($query);
		
		$producto = $resultado['nombre'];
		
		$precio = $resultado['precio'];
		
		$fecha = date("Y-m-d");
		
		mysql_query("INSERT INTO facturas(usuario,producto,precio,fecha) VALUES('$nombre','$producto','$precio','$fecha')",$conexion);
		
		mysql_close($conexion);
		
		header("Location: tienda.php");
	}
	else 
	{
		header("Location: tienda.php");	
	}
   
?>