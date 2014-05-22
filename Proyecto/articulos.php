<?php
	session_start();
    require_once 'php/metodos.php';
	doctype();
?>

	<body>
		<?php
		
			/*********COMPROBAR SI EL ARTÍCULO HA SIDO BORRADO EXITOSAMENTE*********/
			if (isset($_REQUEST['borrado'])) 
			{
				if ($_REQUEST['borrado'] == 1) 
				{?>
					<script language="javascript">
						alert("Borrado correctamente");
					</script>
				<?php		
				} 
				else 
				{?>
					<script language="javascript">
						alert("Fallo al borrar el producto");
					</script>
				<?php
				}
			}
			
			/*********COMPROBAR SI EL ARTÍCULO HA SIDO EDITADO EXITOSAMENTE*********/
			if (isset($_REQUEST['editado'])) 
			{
				if ($_REQUEST['editado'] == 1) 
				{?>
					<script language="javascript">
						alert("Editado correctamente");
					</script>
				<?php		
				} 
				else 
				{?>
					<script language="javascript">
						alert("Fallo al editar el producto");
					</script>
				<?php
				}
			}
			
			/*********COMPROBAR SI EL ARTÍCULO HA SIDO INSERTADO EXITOSAMENTE*********/
			if (isset($_REQUEST['insertado'])) 
			{
				if ($_REQUEST['insertado'] == 1) 
				{?>
					<script language="javascript">
						alert("Insertado correctamente");
					</script>
				<?php		
				} 
				else 
				{?>
					<script language="javascript">
						alert("Fallo al insertar el producto");
					</script>
				<?php
				}
			}
			
			if (isset($_SESSION['usuario']) === TRUE && $_SESSION['usuario'] == 'admin') 
			{?>
				<div id="contenedorPrincipal">
			
				<?php
					require_once 'php/metodos.php';
					cabecera();
				?>
				
				<div id="entrar"> 
					<?php echo "[".$_SESSION['nombre']." ".$_SESSION['apellidos']."]"?>
					<a href="logout.php" id="enlaces">Salir</a>
				</div>
				
				<hr />
				
				<?php
					require_once 'php/metodos.php';
					menuAdmin();
				?>
				
				<form action="articulos.php" method="post">
					<span style="padding-left: 80px;">Ordenar por:</span>
					<select id="opciones" name="opciones">
						<option></option>
						<option value="1" name="1">Precio: de m&aacute;s barato a m&aacute;s caro</option>
						<option value="2" name="2">Precio: de m&aacute;s caro a m&aacute;s barato</option>
						<option value="3" name="3">Ordenar alfab&eacute;ticamente</option>
					</select>
					
					<input type="submit" value="Ejecutar" name="ejecutar" id="ejecutar"/>
					<br /><br />
				</form>
				
				<table id="tablaArticulos" style="border-collapse: collapse;">
					<tr style="background: Gray; color: white">
						<td id="cabeceraArticulos">Nombre</td>
						<td id="cabeceraArticulos">Precio</td>
						<td id="cabeceraArticulos">URL im&aacute;gen</td>
						<td id="cabeceraArticulos">Editar</td>
						<td id="cabeceraArticulos">Borrar</td>
					</tr>
					
					<?php
					
						require_once 'php/metodos.php';
						$conexion = conexion();
						
						if (isset($_REQUEST['ejecutar'])) 
						{
							$resultado = $_REQUEST['opciones'];
							
							if ($resultado == 1) 
							{
								$queryProductos = mysql_query("SELECT * FROM  productos_1 ORDER BY precio ASC");
								tablaArticulos($queryProductos);
							} 
							else 
							{
								if ($resultado == 2) 
								{
									$queryProductos = mysql_query("SELECT * FROM  productos_1 ORDER BY precio DESC");
									tablaArticulos($queryProductos);
								}	
								else 
								{
									if ($resultado == 3) 
									{
										$queryProductos = mysql_query("SELECT * FROM  productos_1 ORDER BY nombre ASC");
										tablaArticulos($queryProductos);
									}
									else 
									{
										$queryProductos = mysql_query("SELECT * from productos_1;",$conexion);
						
										tablaArticulos($queryProductos);
									}	
								}
							}
							
						}
						else 
						{
							$queryProductos = mysql_query("SELECT * FROM  productos_1");
							tablaArticulos($queryProductos);
						}
						
					?>
					
				</table>
				
				<a href="editar.php" id="enlaces">
					<div id="nuevoProducto">
						<p>Pulse para introducir un nuevo producto</p>
						<img src="imagenes/nuevo.png" />
					</div>
				</a>
			<?php
			} 
			else 
			{
				header("Location: index.php");	
			}
			
		?>
		
		<?php
			require_once 'php/metodos.php';
			piePagina();
			
		?>
			
		</div>
	</body>
</html>