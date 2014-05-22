<?php
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
    	
		if(isset($_REQUEST['enviar']))
		{
			require_once 'php/metodos.php';
			$conexion = conexion();
		
			$user = $_REQUEST['user'];
			$password = $_REQUEST['password'];
			$nombre = $_REQUEST['nombre'];
			$apellidos = $_REQUEST['apellidos'];
			
			require_once 'php/metodos.php';
			$conexion = conexion();
			
			/*******SACAR EL MÁXIMO ID DE LA TABLA*******/
			$max = maximoUsuarios($conexion);
			/********************************************/
			
			$query = mysql_query("INSERT INTO usuarios(id,user,password,nombre,apellidos) values('$max','$user',sha1('$password'),'$nombre','$apellidos')",$conexion);
			
			header("Location: login.php?registro=$query");
			
			mysql_close($conexion);
		}
		else 
		{?>		
		        <div id="registro">
					<div id="contenidoRegistro">
						        		
						<h2>Formulario de registro</h2>
						<p id="introduce"></p>
						<br/>
									
						<form method="post" action="registro.php" onsubmit="return validaRegistro()">
							<label>Nombre:
								<input type="text" name="nombre" id="nombre" style="margin-left: 22px; margin-bottom: 15px;"/>
							</label>
								<span id="erroresNombre" class="letraErrores"></span>
							<label>Apellidos:
								<input type="text"  name="apellidos" id="apellidos" style="margin-bottom: 15px;"/>	
							</label>	
								<span id="erroresApellidos" class="letraErrores"></span>
							<label>Usuario:
								<input type="text" id="usuario" type="text" name="user" style="margin-left: 24px;"/>	
								<span class="letra" style="margin-bottom: 15px;">Min. 5 car&aacute;cteres Max. 10 Solo letras</span>
							</label>
								<span id="erroresUsuario" class="letraErrores"></span>
							<label>Password:
								<input id = "password" type="password" name="password" />	
								<span class="letra" style="margin-bottom: 15px;">Min. 6 car&aacute;cteres entre letras y n&uacute;meros</span>
							</label>
								<span id="erroresPassword" class="letraErrores"></span>
							<label>
								<input type="submit" name="enviar" value="Registrarse" id="enviar" style="width:85px; height: 25px;"/> 
							</label> 
						</form>
						
				    </div>
				</div>
						   
				<br />
		<?php
		}
			piePaginaLog();
    	?>
    	<br />
    </div>
</body>
</html>