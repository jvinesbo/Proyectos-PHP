<?php
	session_start();
	require_once 'php/metodos.php';
	doctype();
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
			
			<?php
				$conexion = conexion();
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
			?>
			
			
			
			<div id="entrar">
				<?php echo "[".$_SESSION['nombre']." ".$_SESSION['apellidos']."]"?>
				<a href="logout.php" id="enlaces">Salir</a>
			</div>
			
			<hr />
			
			<?php
				
				if ($_SESSION['usuario'] == 'admin') 
				{
					menuAdmin();
				} 
				else 
				{
					menu();
				}
			?>
			
			<?php
				$conexion = conexion();
				
				$contador = 0;
				
				$queryProductos = mysql_query("SELECT * from productos_1;");
				
				echo "<center>";
					echo "<table>";
					while( $resultado = mysql_fetch_array($queryProductos) )
					{
						if ($contador % 2 == 0)
						{
							require_once 'php/metodos.php';
							tablaTiendaTD_1($resultado);		
						} 
						else 
						{
							require_once 'php/metodos.php';
							tablaTiendaTD_2($resultado);	
						}
						$contador++;
					}
				echo "</center>";
					echo "</table>";
			?>
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