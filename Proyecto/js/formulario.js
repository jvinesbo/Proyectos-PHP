function validaLogin()
{
	var usuario = document.getElementById("usuario").value;
	var password = document.getElementById("password").value;
	
	var booleanoUsuario = blanco(usuario);
	
	if(booleanoUsuario)
	{
		var booleanoPassword = blanco(password);
		if(booleanoPassword)
		{
			var nick = comprobarNick(usuario);
			if(nick)
			{
				var pass = comprobarPassword(password);
				if(pass)
				{
					return true;
				}
				else
				{
						return false;	
				}
			}
			else
			{
				document.getElementById("usuario").style.borderColor='#FF3300';
							
				document.getElementById('erroresUsuario').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del usuario debe <br /> tener solo letras entre 5 y 10 caracteres</p>';	
				return false;	
			}
		}
		else
		{
			document.getElementById("password").style.borderColor='#FF3300';
			document.getElementById("usuario").style.borderColor='#808080';
			document.getElementById('erroresUsuario').style.visibility = "hidden";
			document.getElementById('erroresPassword').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del password esta vacio</p>';
			
			return false;
		}
	}
	else
	{
		document.getElementById("usuario").style.borderColor='#FF3300';
		document.getElementById('erroresUsuario').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del usuario esta vacio</p>';

		return false;	
	}
}

function validaRegistro()
{
	var usuario = document.getElementById("usuario").value;
	var password = document.getElementById("password").value;
	var nombre = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;
	
	var booleanoUsuario = blanco(usuario);
	var booleanoNombre = blanco(nombre);
	var booleanoApellidos = blanco(apellidos);
	
	if(booleanoNombre)
	{
		if(booleanoApellidos)
		{
			if(booleanoUsuario)
			{
				var booleanoPassword = blanco(password);
				if(booleanoPassword)
				{
					var booleanoIguales = iguales(usuario,password);
					if(booleanoIguales)
					{
						var nick = comprobarNick(usuario);
						if(nick)
						{
							var pass = comprobarPassword(password);
							if(pass)
							{
								return true;
							}
							else
							{
								return false;	
							}
						}
						else
						{
							document.getElementById("usuario").style.borderColor='#FF3300';
							
							document.getElementById('erroresUsuario').innerHTML = '<p class="letraErrores" style="color:red;">* Usuario solo letras Max. 10</p>';
							return false;	
						}
					}
					else
					{
						document.getElementById("usuario").style.borderColor='#FF3300';
						document.getElementById("password").style.borderColor='#FF3300';
						document.getElementById("password").style.borderColor='#808080';
						document.getElementById('erroresPassword').style.visibility = "hidden";
						document.getElementById('erroresUsuario').innerHTML = '<p class="letraErrores" style="color:red;">*El usuario y el password son iguales</p>';
						return false;	
					}
				}
				else
				{
					document.getElementById("password").style.borderColor='#FF3300';
					document.getElementById("usuario").style.borderColor='#808080';
					document.getElementById('erroresUsuario').style.visibility = "hidden";
					document.getElementById('erroresPassword').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del password esta vacio</p>';
					return false;
				}
			}
			else
			{
				document.getElementById("usuario").style.borderColor='#FF3300';
				document.getElementById("apellidos").style.borderColor='#808080';
				document.getElementById('erroresApellidos').style.visibility = "hidden";
				document.getElementById('erroresUsuario').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del usuario esta vacio</p>';
				return false;
			}
		}
		else
		{
			document.getElementById("apellidos").style.borderColor='#FF3300';
			document.getElementById("nombre").style.borderColor='#808080';
			document.getElementById('erroresNombre').style.visibility = "hidden";
			document.getElementById('erroresApellidos').innerHTML = '<p class="letraErrores" style="color:red;">*El campo de apellidos esta vacio</p>';
			return false;
		}
	}
	else
	{
		document.getElementById("nombre").style.borderColor='#FF3300';

		document.getElementById('erroresNombre').innerHTML = '<p class="letraErrores" style="color:red;">* El campo del nombre esta vacio</p>';
		
		return false;	
	}
}

function validaEnvio() 
{
	var nom = document.getElementById("nom").value;
	var apellidos = document.getElementById("cognom").value;
	var email = document.getElementById("email").value;
	
	if(!blanco(nom))
	{
		document.getElementById("nom").style.borderColor='#FF3300';
		document.getElementById('erroresNombre').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del nombre esta vacio</p>';
		return false;
	}
	else if(!blanco(apellidos))
	{
		document.getElementById("cognom").style.borderColor='#FF3300';
		document.getElementById("nom").style.borderColor='#808080';
		document.getElementById('erroresNombre').style.visibility = "hidden";
		document.getElementById('erroresApellidos').innerHTML = '<p class="letraErrores" style="color:red;">*El campo de apellidos esta vacio</p>';
		return false;
	}
	else if(!blanco(email))
	{
		document.getElementById("email").style.borderColor='#FF3300';
		document.getElementById("cognom").style.borderColor='#808080';
		document.getElementById('erroresApellidos').style.visibility = "hidden";
		document.getElementById('erroresEmail').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del email esta vacio</p>';
		return false;
	}
	else if(!validaEmail(email))
	{
		document.getElementById("email").style.borderColor='#FF3300';
		document.getElementById('erroresEmail').innerHTML = '<p class="letraErrores" style="color:red;">*El mail no es correcto</p>';
		
		return false;
	}
	else
	{
		return true;
	}
}

function validaEmail(mail)
{	
	var expresion =/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:[A-Z]{2}|com|org|net|biz|info|mobi|cat|es|ar)$/i;
	
	if(mail.match(expresion))
	{
		return true;
	}
	else
	{	
		return false;
	}
}

function comprobarNick(usuario)
{
	var expresion = /^[a-zA-Z0]{4,10}$/; 
	
	if(usuario.match(expresion) && usuario.length < 10)
	{
		return true;
	}
	else
	{	
		return false;
	}
}

function comprobarPassword(password)
{
	var contadorLetras = parseInt(0);
	var contadorNumeros = parseInt(0);
	var expresionLetra = /^[a-zA-Z]$/;
	var expresionNumero = /^[0-9]/;
	
	if(password.length < 6)
	{
		document.getElementById("password").style.borderColor='#FF3300';
		document.getElementById("usuario").style.borderColor='#808080';
		document.getElementById('erroresUsuario').style.visibility = "hidden";
		document.getElementById('erroresPassword').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del password debe <br /> contener un mínimo de 6 caracteres</p>';
		
		return false;
	}
	else
	{
		for(var i = 0; i < password.length; i++)
		{
			var letra = password.charAt(i);
			
			if(letra.match(expresionLetra))
			{
				contadorLetras++;
			}
			else if(letra.match(expresionNumero))
			{
				contadorNumeros++;
			}
		}
	}
	
	if(contadorLetras > 0 && contadorNumeros > 0)
	{
		return true;
	}
	else
	{
		document.getElementById("password").style.borderColor='#FF3300';
		document.getElementById("usuario").style.borderColor='#808080';
		document.getElementById('erroresUsuario').style.visibility = "hidden";
		document.getElementById('erroresPassword').innerHTML = '<p class="letraErrores" style="color:red;">*El campo del password debe tener <br /> al menos una letra y un número</p>';
		
		return false;
	}
}

function iguales(usuario,password)
{	
	if(usuario == password)
	{	
		return false;
	}
	else
	{
		return true;
	}
}

function validaNuevoProducto()
{
	var nombre = document.getElementById("campoNombre").value;
	var precio = document.getElementById("campoPrecio").value;

	if(!blanco(nombre))
	{
		document.getElementById("campoNombre").style.borderColor='#FF3300';
		document.getElementById('erroresNombre').innerHTML = '<h3 class="letraErrores" style="color:red;">*El campo del nombre esta vacio</h3>';
		
		return false;
	}
	else if(!blanco(precio))
	{
		document.getElementById("campoPrecio").style.borderColor='#FF3300';
		document.getElementById("campoNombre").style.borderColor='#808080';
		document.getElementById('erroresNombre').style.visibility = "hidden";
		document.getElementById('erroresPrecio').innerHTML = '<h3 class="letraErrores" style="color:red;">*El campo del precio esta vacio</h3>';
		return false;
	}
	else if(!numero(precio))
	{
		document.getElementById("campoPrecio").style.borderColor='#FF3300';
		document.getElementById('erroresPrecio').innerHTML = '<h3 class="letraErrores" style="color:red;">*Tienes que introducir números</h3>';
		return false;
	}
	else
	{
		return true;
	}
}

function blanco(variable)
{
	if(variable.length <= 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function numero(variable)
{
	var expresion = /^([0-9])*[.]?[0-9]*$/;
	
	if (variable.match(expresion)) 
	{
		return true;
	} 
	else
	{
		return false;	
	}
}





