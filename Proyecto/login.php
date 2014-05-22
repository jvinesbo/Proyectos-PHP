<?php
	session_start();
	require_once 'php/metodos.php';
	doctype();
?>

<body>
	
	<div id="contenedorPrincipal">
    <?php
    	cabecera();
	?>
		<hr /><br />
	
		<div id="entrar">
			<a href="registro.php" id="enlaces">Registrarse</a>
			<a href="login.php" id="enlaces">Log in</a>
		</div>
				
		<hr /><br />
	<?php	
    	/**** COMPROBAR SI SE HA REGISTRADO CORRECTAMENTE ****/
    	if (isset($_REQUEST['registro'])) 
    	{
			if ($_REQUEST['registro'] == 1) 
			{?>
				<script language="JavaScript">
					alert("Registrado correctamente");
				</script>
			<?php
			} 
			
			else 
			{?>
				<script language="JavaScript">
					alert("No ha podido registrarse");
				</script>
			<?php
			}
				
		}
    	
		if (isset($_REQUEST['login']))
		{
			$nombre = $_REQUEST['nombre'];
			$password = $_REQUEST['password'];
			
			require_once 'php/metodos.php';
			$conexion = conexion();
			
			$queryNombre = mysql_query("SELECT * FROM usuarios WHERE user = '$nombre'",$conexion);
			$queryPassword = mysql_query("SELECT * FROM usuarios WHERE password = sha1('$password')",$conexion);
			
			if (mysql_num_rows($queryNombre) == 0) 
			{?>	
					<div id="contenedor">
		    
				        <div id="formulario">
				        	<div id="contenidoFormulario">
				        		<span id="proba" style="visibility: hidden;">
									<script>
										document.getElementById('proba').style.visibility = "visible";
										document.getElementById('proba').innerHTML = '<p class="letraErrores" style="color:red; margin-left:250px;">* Usuario no encontrado en nuestra base de datos</p>';
									</script>
								</span>	
				               <h2>Formulario de login</h2>
							    <p id="introduce">Introduce tus datos de logueo</p>
							    <br/>
							    <form id="login" method="post" action="login.php" onsubmit="return validaLogin()">  
							    	<label for="nombre">Usuario:
							        	<input id = "usuario" type="text" name="nombre" class="medidaInput" style="margin-bottom: 20px; margin-left: 25px;"/> 
							            <span id="erroresUsuario" class="letraErrores"></span>
							        </label>
							                    	
							        <label for="pasword">Password:
							        	<input id = "password" type="password" name="password" class="medidaInput" style="margin-bottom: 20px;"/>
							            <span id="erroresPassword" class="letraErrores"></span>
							        </label>
							                    
							        <input type="submit" name="login" value="Entrar" id="enviar"/>
								</form>
				            </div>
				        </div>
				        <br />
				    </div>
			<?php
			}
			else 
			{
				if (mysql_num_rows($queryPassword) == 0)
				{?>
					
					
					<div id="contenedor">
		    				
				        <div id="formulario">
				        	<div id="contenidoFormulario">
				        			<span id="proba" style="visibility: hidden;">
										<script>
											document.getElementById('proba').style.visibility = "visible";
											document.getElementById('proba').innerHTML = '<p class="letraErrores" style="color:red; margin-left:350px;">* Password incorrecto</p>';
										</script>
									</span>	
				                <h2>Formulario de login</h2>
							    <p id="introduce">Introduce tus datos de logueo</p>
							    <br/>
							    <form id="login" method="post" action="login.php" onsubmit="return validaLogin()">  
							    	<label for="nombre">Usuario:
							        	<input id = "usuario" type="text" name="nombre" class="medidaInput" style="margin-bottom: 20px; margin-left: 25px;"/> 
							            <span id="erroresUsuario" class="letraErrores"></span>
							        </label>
							                    	
							        <label for="pasword">Password:
							        	<input id = "password" type="password" name="password" class="medidaInput" style="margin-bottom: 20px;"/>
							            <span id="erroresPassword" class="letraErrores"></span>
							        </label>
							                    
							        <input type="submit" name="login" value="Entrar" id="enviar"/>
								</form>
				            </div>
				        </div>
				        <br />
				    </div>
				<?php	
				}	
				else
				{
					$query = mysql_query("SELECT nombre,apellidos FROM usuarios WHERE user = '$nombre'",$conexion);
					
					$resultado = mysql_fetch_array($query);
					
					if($nombre != null)
					{
						$_SESSION['usuario'] = $nombre;
						$_SESSION['nombre'] = $resultado['nombre'];
						$_SESSION['apellidos'] = $resultado['apellidos'];
						if ($nombre == 'admin') 
						{
							header("Location: articulos.php");	
						} 
						else 
						{
							header("Location: tienda.php");		
						}
					}
					else 
					{
						header("Location: index.php");		
					}
				}
			}
		}
		else
		{?>
			
			<div id="contenedor">
				<div id="formulario">
					<div id="contenidoFormulario">
					        		
						<h2>Formulario de login</h2>
					    <p id="introduce">Introduce tus datos de logueo</p>
					    <br/>
					    <form id="login" method="post" action="login.php" onsubmit="return validaLogin()">  
					    	<label for="nombre">Usuario:
					        	<input id = "usuario" type="text" name="nombre" class="medidaInput" style="margin-bottom: 20px; margin-left: 25px;"/> 
					            <span id="erroresUsuario" class="letraErrores"></span>
					        </label>
					                    	
					        <label for="pasword">Password:
					        	<input id = "password" type="password" name="password" class="medidaInput" style="margin-bottom: 20px;"/>
					            <span id="erroresPassword" class="letraErrores"></span>
					        </label>
					                    
					        <input type="submit" name="login" value="Entrar" id="enviar"/>
						</form>           
					</div>
				</div>
				<br />
		    </div>
		<?php
		}

			require_once 'php/metodos.php';
			piePaginaLog();
		
		?>
		<br />
	</div>
</body>
</html>