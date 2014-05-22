<?php
	session_start();
	
	require_once 'php/metodos.php';
	doctype();
?>

<body>
	<div id="contenedorPrincipal">
		
		<?php
			require_once 'php/metodos.php';
			cabecera();
		?>
		
		<?php
			if (isset($_SESSION['usuario']) === TRUE) 
			{?>
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
			}
			else 
			{?>
				<hr /><br />
	
				<div id="entrar">
					<a href="registro.php" id="enlaces">Registrarse</a>
					<a href="login.php" id="enlaces">Log in</a>
				</div>
						
				<hr /><br />
				
			<?php
			}
			?>
		<?php
			piePagina();
		
		?>
	</div>
</body>
</html>