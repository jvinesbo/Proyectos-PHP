<?php
	session_start();
	require_once 'php/metodos.php';
	doctype();
?>

	<body>
		<?php
			if (isset($_SESSION['usuario']) === TRUE && $_SESSION['usuario'] == 'admin') 
			{?>
				<div id="contenedorPrincipal">
		
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
				
				<form action="avisos.php" method="post">
					<span style="padding-left: 80px;">Mostrar:</span>
					<select id="opciones" name="opciones">
						<option></option>
						<option value="1" name="1">Productos Caducados</option>
						<option value="2" name="2">Productos que caducan hoy</option>
						<option value="3" name="3">Productos que caducan este mes</option>
					</select>
					
					<input type="submit" value="Ejecutar" name="ejecutarAvisos" id="ejecutar"/>
					<br /><br />
				</form>
				
				<center>
						<?php
							$conexion = conexion();
							$contador = 0;
							
							$queryContador = mysql_query("SELECT * FROM productos_1",$conexion);
							$resultadoContador = mysql_num_rows($queryContador);
	
							$anyoActual = date("Y");
							$diaActual = date("d");
							$mesActual = date("m");
							
							$queryDia = mysql_query("SELECT DAY(fecha) FROM productos_1",$conexion);
							$queryMes = mysql_query("SELECT MONTH(fecha) FROM productos_1",$conexion);
							$queryAnyo = mysql_query("SELECT YEAR(fecha) FROM productos_1",$conexion);
							$query = mysql_query("SELECT * FROM productos_1",$conexion);
							
							$vectorCaducados = array();
							$vectorCaducadosHoy = array();
							$vectorCaducadosMes = array();
							$vectorNOCaducados = array();
							
							while ($contador < $resultadoContador) 
							{
									$resultadoDia = mysql_fetch_array($queryDia);
									$resultadoMes = mysql_fetch_array($queryMes);
									$resultadoAnyo = mysql_fetch_array($queryAnyo);
									$resultado =  mysql_fetch_array($query);
									
									if ($resultadoAnyo['YEAR(fecha)'] == $anyoActual && $resultadoMes['MONTH(fecha)'] == $mesActual && $resultadoDia['DAY(fecha)'] == $diaActual) 
									{
										array_push($vectorCaducadosHoy,$resultado['codigo']);
									} 
									else 
									{
										if ($resultadoAnyo['YEAR(fecha)'] == $anyoActual && $resultadoMes['MONTH(fecha)'] == $mesActual && $resultadoDia['DAY(fecha)'] > $diaActual) 
										{
											array_push($vectorCaducadosMes,$resultado['codigo']);
										} 
										else 
										{
											if ($resultadoAnyo['YEAR(fecha)'] > $anyoActual) 
											{
												array_push($vectorNOCaducados,$resultado['codigo']);
											}
											else
											{
												if ($resultadoAnyo['YEAR(fecha)'] < $anyoActual) 
												{
													array_push($vectorCaducados,$resultado['codigo']);
												} 
												else 
												{
													if ($resultadoAnyo['YEAR(fecha)'] == $anyoActual) 
													{
														if ($resultadoMes['MONTH(fecha)'] < $mesActual) 
														{
															array_push($vectorCaducados,$resultado['codigo']);
														} 
														else 
														{
															if ($resultadoMes['MONTH(fecha)'] == $mesActual) 
															{
																if ($resultadoDia['DAY(fecha)'] < $diaActual) 
																{
																	array_push($vectorCaducados,$resultado['codigo']);
																}
																else 
																{
																	array_push($vectorNOCaducados,$resultado['codigo']);
																}
															}
															else 
															{
																array_push($vectorNOCaducados,$resultado['codigo']);	
															}
														}
														
													} 
												}
												
											}
										}
										
									}
									
									$contador++;
							}
						?>
						
						<?php
							$conexion = conexion();
							
							if (isset($_REQUEST['ejecutarAvisos'])) 
							{
								$resultado = $_REQUEST['opciones'];
								
								if ($resultado == 1) 
								{
									tablaAvisos($vectorCaducados,$conexion,"Productos Caducados");
								?>
									<form action="avisos.php" method="post">
										<input type="submit" name="borrarCaducados" value="Borrar Productos Caducados" id="ejecutar" style="margin-top: 40px; margin-left: 450px;"/>
									</form>
								<?php
								} 
								else 
								{
									if ($resultado == 2) 
									{
										tablaAvisos($vectorCaducadosHoy,$conexion,"Productos caducan hoy");
									}	
									else 
									{
										if ($resultado == 3) 
										{
											tablaAvisos($vectorCaducadosMes,$conexion,"Productos caducan este mes");
										}
										else 
										{
											tablaAvisos($vectorNOCaducados,$conexion,"Productos NO Caducados");
										}	
									}
								}
								
							}
							else 
							{
								tablaAvisos($vectorNOCaducados,$conexion,"Productos NO Caducados");
							}
							
						?>
						
					</center>
					
					<?php
						if (isset($_REQUEST['borrarCaducados'])) 
						{
								for ($i=0; $i < count($vectorCaducados); $i++) 
								{ 
									 borrar($conexion, $vector[$i]);
								}
						}
					?>
					
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
