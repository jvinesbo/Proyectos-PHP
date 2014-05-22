<?php
	session_start();
    require_once 'php/metodos.php';
	doctype();
	require_once 'php/metodos.php';
	$conexion = conexion();
?>
	<body>
		
		<?php	
			if (isset($_SESSION['usuario']) === TRUE) 
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
				
				<form method="post" action="factura.php">
					<input type="submit" name="ultima" id="ejecutar" value="&Uacute;ltima Factura" style="margin-bottom: 10px; margin-left: 50px;" />
				</form>
				<hr />
				<?php
					if($_SESSION['usuario'] == 'admin')
					{
						menuAdmin();
					}
					else
					{
						menu();
					}
				?>
				<table id="tablaFacturas" style="width: 500px;">
					
					<tr>
						<td>Producto</td>
						<td>Fecha</td>
						<td>Precio</td>
					</tr>
					
					<?php
						
						if (isset($_REQUEST['comprar'])) 
						{
							$max = maximoFacturas($conexion);
							$query = mysql_query("SELECT * FROM facturas");
							
							while ($resultado = mysql_fetch_array($query)) 
							{
								$usuario = $resultado['usuario'];
								$producto = $resultado['producto'];
								$precio = $resultado['precio'];
								$fecha = date("Y-m-d");
								
								mysql_query("INSERT INTO compras(codigoFactura,usuario,producto,precio,fecha) VALUES('$max','$usuario','$producto','$precio','$fecha')",$conexion);
							}
							
							header("Location: factura.php");
						}
						
						if(isset($_REQUEST['ultima']))
						{
							echo "<center><h2>"."&Uacute;ltima Factura"."</h2></center><br />";
							$nombre = $_SESSION['usuario'];
							$max = maximoUltimaFactura($conexion,$nombre);
							
							$query = mysql_query("SELECT * FROM compras WHERE codigoFactura = '$max' AND usuario = '$nombre'",$conexion);
							
							$total = 0;
							while ($resultado = mysql_fetch_array($query)) 
							{
									echo "<tr>";
										echo "<td>".$resultado['producto']."</td>";
										echo "<td>".$resultado['fecha']."</td>";
										echo "<td>".$resultado['precio']."</td>";
									echo "</tr>";
									
									$total += $resultado['precio'];
							}
							echo "<tr>";
								echo "<td>TOTAL</td>";
								echo "<td></td>";
								echo "<td style='color: red; font-weight:bold;'>$total &euro;</td>";
							echo "</tr>";
							
							/***********************MOSTRAR EL CARRITO SI TIENE ALGÚN PRODUCTO INSERTADO****************************/	
							$resultado = contarFilas($conexion);
							
							if ($resultado > 0) 
							{?>
								<table>
									<tr>
										<td><a href="factura.php"><img src="imagenes/carrito.png" alt="Carrito" id="carrito"/></a></td>
										<td style="padding-top: 20px; padding-left: 20px;">Productos: <?php echo $resultado?></td>
									</tr>	
								</table>
							<?php		
							}
							else 
							{?>
								<table id="tablaCarrito">
									<tr>
										<td><a href="factura.php"><img src="imagenes/carrito.png" alt="Carrito" id="carrito"/></a></td>
										<td style="padding-top: 20px; padding-left: 20px; visibility: hidden;"></td>
									</tr>	
								</table>
							<?php
							}
						}
						else 
						{
							echo "<center><h2>"."Carrito de la compra"."</h2></center>";
							$query = mysql_query("SELECT * FROM facturas;",$conexion);
							
							$total = 0;
							
							while ($resultado = mysql_fetch_array($query)) 
							{
									echo "<tr>";
										echo "<td>".$resultado['producto']."</td>";
										echo "<td>".$resultado['fecha']."</td>";
										echo "<td>".$resultado['precio']."</td>";
									echo "</tr>";
									
									$total += $resultado['precio'];
							}
							echo "<tr>";
								echo "<td>TOTAL</td>";
								echo "<td></td>";
								echo "<td style='color: red; font-weight:bold;'>$total &euro;</td>";
							echo "</tr>";
							
							echo "<form>";
								echo'<input type="submit" id="ejecutar" value="Comprar" name="comprar" style="margin-bottom: 30px; margin-left: 550px;"/>';
							echo "</form>";
						}
					?>
					
				</table>
				
				
				
				
				
				<?php
					require_once 'php/metodos.php';
					piePagina();		
				?>
			</div>
			<?php	
			} 
			else 
			{
				header("Location: index.php");
			}
			
			
		?>
	</body>
</html>
