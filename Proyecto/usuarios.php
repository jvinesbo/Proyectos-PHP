<?php
    session_start();
    require_once 'php/metodos.php';
	doctype();
?>
	<?php
		if (isset($_SESSION['usuario']) === TRUE && $_SESSION['usuario'] == 'admin') 
		{?>
			<div id="contenedorPrincipal">
			
				<?php
					cabecera();
				?>
					
				<div id="entrar"> 
					<?php echo "[".$_SESSION['nombre']."]"?>
					<a href="logout.php" id="enlaces">Salir</a>
				</div>
					
				<hr />
					
				<?php
					menuAdmin();
				?>
				
			
			<center>
				<table id="tablaArticulos" border="1" style="border-collapse: collapse; font-family: Purisa; border: 2px solid black;">
					
					<tr style="background: grey">
						<td>Nombre log in</td>
						<td>Nombre</td>
						<td>Apellidos</td>
					</tr>
					
					<?php
						$conexion = conexion();
						
						$query = mysql_query("SELECT * FROM usuarios");
						
						while ($resultado = mysql_fetch_array($query)) 
						{
							if ($resultado['user'] != 'admin') 
							{
								echo "<tr id='tablaArticulosPares'>";
									echo "<td>".$resultado['user']."</td>";
									echo "<td>".$resultado['nombre']."</td>";
									echo "<td>".$resultado['apellidos']."</td>";
								echo "</tr>";
							}	
						}
					?>
				</table>
			</center>
			<?php
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