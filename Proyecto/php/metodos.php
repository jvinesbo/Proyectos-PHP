
<?php
	function cabecera()
	{
		echo "<img src='imagenes/cabecera.gif' height='200px' width='580px' style='margin-left: 100px;'/>";
	}

	function menu()
	{		
			echo "<div id='menu'>";
				echo "<ul>";
					echo "<a href='index.php'><li>Inicio</li></a>";
					echo "<a href='tienda.php'><li>Tienda</li></a>";
					echo "<a href='formularioEnvio.php'><li>Contacto</li></a>";
				echo "</ul>";
				echo "<hr />";
				echo "<br />";
			echo "</div>";
	}
	
	function menuAdmin()
	{
			echo "<div id='menu'>";
				echo "<ul>";
					echo "<a href='index.php'><li>Inicio</li></a>";
					echo "<a href='tienda.php'><li>Tienda</li></a>";
					echo "<a href='formularioEnvio.php'><li>Contacto</li></a>";
					echo "<a href='articulos.php'><li>Art&iacute;culos</li></a>";
					echo "<a href='avisos.php'><li>Avisos</li></a>";
					echo "<a href='usuarios.php'><li>Usuarios</li></a>";
				echo "</ul>";
				echo "<hr />";
				echo "<br />";
			echo "</div>";
	}

	function doctype()
	{
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
		echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
		echo "<head>";
			echo "<meta http-equiv='Content-Type' content='text/html;' charset='utf-8' />";
			echo "<link rel='stylesheet' type='text/css' href='css/estilo.css' media='screen'/>";
			echo "<script type='text/javascript' src='js/formulario.js'></script>";
			echo '<link rel="shortcut icon" href="images.ico" type="image/x-icon" />';
			echo "<title>Almac&eacute;n de papeleria</title>";
		echo "</head>";
	}
	
	function conexion()
	{
		$conexion = mysql_connect("localhost","root","");	
		mysql_select_db("papeleria",$conexion);
		
		return $conexion;
	}
	
	function tablaTiendaTD_1($resultado)
	{
		echo "<tr>";
			echo "<td id='tdTienda'>";
				echo "<h3 id='letraTienda'>".$resultado['nombre']."</h3>"."<div id='divAnyadir'>".'<a href="carrito.php?id='.$resultado['codigo'].'" id ="anyadir"">Añadir</a>'."</div>";
				echo "<img src='imagenes/".$resultado['imagenes']."'' alt='bic' id='imagenesTienda' />";
				echo "<p id='pvp'>P.V.P</p>";
				echo "<h3 id='precio'>".$resultado['precio']."</h3>"."<br />";
				echo "<p class='letra' style='padding-left: 30px; padding-top:10px;'>Precio indicado en &euro; I.V.A. incluido</p>";
			echo "</td>";
			echo "<td style='width: 20px;'></td>";
	}
	
	function tablaTiendaTD_2($resultado)
	{
			echo "<td id='tdTienda'>";
				echo "<h3 id='letraTienda'>".$resultado['nombre']."</h3>"."<div id='divAnyadir'>".'<a href="carrito.php?id='.$resultado['codigo'].'" id ="anyadir"">Añadir</a>'."</div>";
				echo "<img src='imagenes/".$resultado['imagenes']."'' alt='bic' id='imagenesTienda'/>";
				echo "<p id='pvp'>P.V.P</p>";
				echo "<h3 id='precio'>".$resultado['precio']."</h3>"."<br />";
				echo "<p class='letra' style='padding-left: 30px; padding-top:10px;'>Precio indicado en &euro; I.V.A. incluido</p>";
			echo "</td>";
	
		echo "</tr>";
						
		echo "<tr style='height: 20px;'></tr>";
	}
	
	function piePagina()
	{
		echo "<div id='pie'>";
			echo "<hr />";
					echo "<p>Papeleria Vinyes S.L - Genov&eacute;s (Valencia) - 630416173 - vinyes@hotmail.es</p>";
			echo "<hr />";
		echo "</div>";
	}

	function piePaginaLog()
	{
		echo "<div id='pieLog'>";
			echo "<hr />";
					echo "<p>Papeleria Vinyes S.L - Genov&eacute;s (Valencia) - 630416173 - vinyes@hotmail.es</p>";
			echo "<hr />";
		echo "</div>";
	}
	
	function maximoProductos($conexion)
	{
			$query = mysql_query("SELECT MAX(codigo) AS codigo FROM productos_1",$conexion);
			
			$resul = mysql_fetch_array($query);
	
			$max = $resul['codigo'];
			$max++;
			
			return $max;
	}

	function maximoFacturas($conexion)
	{
			$query = mysql_query("SELECT MAX(codigoFactura) AS codigoFactura FROM compras",$conexion);
			
			$resul = mysql_fetch_array($query);
	
			$max = $resul['codigoFactura'];
			$max++;
			
			return $max;
	}
	
	function maximoUltimaFactura($conexion,$nombre)
	{
			$query = mysql_query("SELECT codigoFactura,usuario FROM compras",$conexion);
			$max = 0;
			
			while($resul = mysql_fetch_array($query))
			{
				if($resul['usuario'] == $nombre && $resul['codigoFactura'] > $max)
				{
					$max = $resul['codigoFactura'];
				}
			}
			
			return $max;
	}

	function maximoUsuarios($conexion)
	{
			$query = mysql_query("SELECT MAX(id) AS id FROM usuarios",$conexion);
			
			$resul = mysql_fetch_array($query);
	
			$max = $resul['id'];
			$max++;
			
			return $max;
	}
	
	function tablaArticulos($queryProductos)
	{
		$contador = 0;
								
		while( $resultado = mysql_fetch_array($queryProductos) )
		{
			if ($contador % 2 == 0)
			{
				echo "<tr id='tablaArticulosPares'>";
			} 
			else 
			{
				echo "<tr id='tablaArticulosImpares'>";
			}
			
				echo "<td>".$resultado['nombre']."</td>";
				echo "<td>".$resultado['precio']."</td>";
				echo "<td>".$resultado['imagenes']."</td>";
				echo '<td><a href="editar.php?id='.$resultado['codigo'].'"><img src="imagenes/editar.png"></a></td>';
				echo '<td><a href="borrar.php?id='.$resultado['codigo'].'" onclick="return confirm(\'Está seguro de borrar\')"><img src="imagenes/borrar.png"></a></td>';
			echo "</tr>";
			
			$contador++;
		}
	}

	function borrar($conexion,$id)
	{
		mysql_query("DELETE FROM productos_1 WHERE codigo = '$id'");
	}
	
	function borrarFacturas($conexion,$nombre)
	{
		mysql_query("DELETE FROM facturas WHERE usuario = '$nombre'");
	}
	
	function contarFilas($conexion)
	{
		$query = mysql_query("SELECT * FROM facturas",$conexion);
	
		$resultado = mysql_num_rows($query);
	
		return $resultado;
	}
	
	function tablaAvisos($vector,$conexion,$titulo)
	{
		echo "<h1 style='ont-family: Purisa;'>".$titulo."</h1>";
		echo '<table id="tablaArticulos" border="1" style="border-collapse: collapse; font-family: Purisa; border: 2px solid black;">';
		
			echo '<tr style="background: Gray; color: white">';
				echo '<td id="cabeceraArticulos">'.'Nombre'.'</td>';
				echo '<td id="cabeceraArticulos">'.'Fecha'.'</td>';
			echo '</tr>';
		
			for ($i=0; $i < count($vector); $i++) 
			{
				$query= mysql_query("SELECT * FROM productos_1 WHERE codigo = '$vector[$i]'");
				$resultado = mysql_fetch_array($query);
				echo "<tr id='tablaArticulosPares'>";
					echo "<td>".$resultado['nombre']."</td>";
					echo "<td>".$resultado['fecha']."</td>";
				echo "</tr>";
			}	 
		echo "</table>";
	}
?>







