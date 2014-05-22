<?php

	session_start();
	require_once 'php/metodos.php';
	$conexion = conexion();
	
	if (isset($_SESSION['usuario']) === TRUE) 
	{
		$nombre = $_SESSION['usuario'];
		borrarFacturas($conexion,$nombre);
		
		session_destroy();
		header("Location: index.php");	
	} 
	else 
	{
		header("Location: index.php");	
	}
    
?>