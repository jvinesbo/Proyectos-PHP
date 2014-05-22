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
							cabecera();
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
							
						<h1 style="font-family: Purisa; text-align: center;">Enviar comentarios</h1>
						<div id="formularioEnvio">
							<form method="post" action="formularioEnvio.php" onsubmit="return validaEnvio()">
									<label>Nombre:
										<input type="text" name="nombre" class="medidaInput" style="margin-left: 34px;" id="nom"/>
									</label>
										<span id="erroresNombre" class="letraErrores"></span>
									<label>Apellidos:
										<input type="text" name="apellidos" class="medidaInput" style="margin-left: 24px;" id="cognom"/>
									</label>
										<span id="erroresApellidos" class="letra"></span>
									<label>Email:
										<input type="text" name="email" class="medidaInput" style="margin-left: 58px;" id="email"/>
									</label>
										<span id="erroresEmail" class="letraErrores"></span>
									<label>Comentarios:
										<textarea name="texto" cols="32" rows="6" id="text"></textarea>
									</label>
									
									<input type="submit" name="enviar" value="Enviar" id="ejecutar" style="margin-left: 350px; width: 90px;"/>
							</form>
						</div>
			
						<?php
						
							if (isset($_REQUEST['enviar'])) 
							{
								$fecha = date("d-m-Y");
								$hora = date("H:i:s");
								$destino = "vinyes@hotmail.es";
								$asunto = "Comentario";
								$desde ="From: ".$_REQUEST['email'];
						
								$nombre = $_REQUEST['nombre'];	
								$apellidos = $_REQUEST['apellidos'];	
								$email = $_REQUEST['email'];
								$texto = $_REQUEST['texto'];
								
								$comentario = "Nombre: ".$nombre."\n";	
								$comentario .= "Apellidos: ".$apellidos."\n";
								$comentario .= "Comentario: ".$texto."\n";	
								$comentario .= "Enviado: ".$fecha." a las ".$hora."\n";			
								
							 	if(mail($destino, $asunto, $comentario, $desde))
								{?>
									<script language="javascript">
										alert("Comentario enviado correctamente");
									</script>
								<?php
								}
								else 
								{?>
									<script language="javascript">
										alert("El mensaje no se ha podido enviar");
									</script>
								<?php	
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