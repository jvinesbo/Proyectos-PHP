<?php
	session_start();
    require_once 'php/metodos.php';
	doctype();
?>

	<body>
		<div id="contenedorPrincipal">
		<?php
			if(isset($_SESSION['usuario']) === TRUE && $_SESSION['usuario'] == 'admin')
			{?>
				
		
				<?php
					require_once 'php/metodos.php';
					cabecera();
				?>
				
				<div id="entrar">
					<?php echo "[".$_SESSION['usuario']."]"?>
					<a href="logout.php" id="enlaces">Salir</a>
				</div>
				
				<hr />
				<?php
					menuAdmin();
				?>
				<br />
				
				<?php
					if (isset($_GET['id']) === TRUE) 
					{
						$id = $_GET['id'];	
								
						require_once 'php/metodos.php';
						$conexion = conexion();
								
						$query = mysql_query("SELECT * FROM productos_1 WHERE codigo = '$id'",$conexion);
								
						$resultado = mysql_fetch_array($query);
								
					?>
								
					<div id="formularioEditar">
						<p>Formulario edici&oacute;n de art&iacute;culos</p>
						<form id="login" method="post" action="editar.php" enctype="multipart/form-data" onsubmit="return validaNuevoProducto()">
							<label>Nombre:
								<input type="text" name="nombre" id="campoNombre" class="medidaInput" style="margin-left: 48px;" value="<?php echo $resultado['nombre']?>"/>
							</label>
								<span id="erroresNombre" class="letraErrores"></span>
							<label>Precio:
								<input type="text" name="precio" id="campoPrecio" class="medidaInput" style="margin-left: 60px;"  value="<?php echo $resultado['precio']?>"/>
							</label>
								<span id="erroresPrecio" class="letraErrores"></span>
							<label>URL im&aacute;gen:
								<input type="file" name="foto" id="campoFoto"/>
							</label>
								<input type="text" name="id" value="<?php echo $resultado['codigo']?>" style="visibility: hidden;"/>
								<input type="submit" name="editar" value="Guardar Producto" id="editar"/>
						</form>
					</div>
	
					<?php	
					}
					else 
					{
						if (isset($_REQUEST['nuevoProducto'])) 
						{
							$nombre = $_REQUEST['nombre'];
							$precio = $_REQUEST['precio'];
							$fecha = $_REQUEST['datepicker'];
							$nombreFoto = $_FILES['foto']['name'];
							
							require_once 'php/metodos.php';
							$conexion = conexion();
							
							/*******SACAR EL MÁXIMO ID DE LA TABLA*******/
							$max = maximoProductos($conexion);
							/********************************************/		
							
							$nombreFoto = "imagenes_tienda/".$nombreFoto;
							
							$query = mysql_query("INSERT INTO productos_1(codigo,nombre,precio,imagenes,fecha) values('$max','$nombre','$precio','$nombreFoto','$fecha')");
							
							header("Location: articulos.php?insertado=$query");
							
							mysql_close($conexion);
						}
						else 
						{?>							
							<div id="formularioEditar">
								<p>Formulario nuevo art&iacute;culo</p>
								<form id="login" method="post" action="editar.php" enctype="multipart/form-data" onsubmit="return validaNuevoProducto()">
									<label>Nombre:
										<input type="text" name="nombre" id="campoNombre" class="medidaInput"/>
									</label>
										<span id="erroresNombre" class="letraErrores"></span>
									<label>Precio:
										<input type="text" name="precio" id="campoPrecio" class="medidaInput" style="margin-left: 28px;"/>
									</label>
										<span id="erroresPrecio" class="letraErrores"></span>
									<label style="width: 450px ;">Fecha:
	       								<input type="date" name="datepicker" class="medidaInput" style="margin-left: 35px;" />
	       							</label>
	       							<label>URL im&aacute;gen:
											<input type="file" name="foto" id="campoFoto"/>
									</label>
									<input type="submit" name="nuevoProducto" value="Nuevo Producto" id="editar"  style="margin-top: 20px;"/>
								</form>
							</div>
						<?php
						}
						
						if(isset($_REQUEST['editar']))
						{		
							$nombre = $_REQUEST['nombre'];
							$precio = $_REQUEST['precio'];
							$codigo = $_REQUEST['id'];
							
							require_once 'php/metodos.php';
							$conexion = conexion();
							
							if (empty($_FILES['foto']['name'])) 
							{
								$query = mysql_query("UPDATE productos_1 SET nombre = '$nombre', precio = '$precio',imagenes = imagenes WHERE codigo = '$codigo'",$conexion);	
							} 
							else 
							{
								$foto = $_FILES['foto']['name'];
								$foto = "imagenes_tienda/".$foto;
								$query = mysql_query("UPDATE productos_1 SET nombre = '$nombre', precio = '$precio', imagenes = '$foto' WHERE codigo = '$codigo'",$conexion);	
							}
							
							header("Location: articulos.php?editado=$query");
							
							mysql_close($conexion);
						}
					}
			
			}
			else 
			{
				header("Location: index.php");
			}
	
				require_once 'php/metodos.php';
				piePagina();
				
			?>
			</div>
	</body>
</html>