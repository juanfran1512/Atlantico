<?php
session_start();

if(!empty($_POST['usuario'])){
?> <script > console.log("<?php  echo $_POST['usuario'];?>"); </script> <?php
include_once("modelo/clsLogin.php");
//--------------------------------------------------------------------
//       Controlador Login
//--------------------------------------------------------------------
/*strip_tags:  nos salva de posibles inyecciones SQL*/
	$usuario = strip_tags($_POST['usuario']);
	$pass = sha1(md5(strip_tags($_POST['pass'])));

//se crea el Objeto login de la clase Login
	$objLogin = new claseLogin();

//y se envian los datos a la clase login
	$objLogin->manejar_datos($usuario,$pass);

//--------------------------------------------------------------------
//       Funcion para buscar si el usuario existe
//--------------------------------------------------------------------

	if($_POST['btnLogeo']){
		 $objLogin->buscaAcceso();
		 if($objLogin->error==true){
		 	$msj ="superman";
		 }else{
		if($arreglo_buscar = $objLogin->row()){

			$_SESSION["cedula"]= $arreglo_buscar['ced_usu'];
			$_SESSION["nombre"]= $arreglo_buscar['nom_usu'];
			$_SESSION["usuario"]= $arreglo_buscar['nick_usu'];
			$_SESSION["tipo"]= $arreglo_buscar['tip_usu'];

			// $msj = "SI BUSCO y el n de rol es: ".$_SESSION["tipo"]." y el nombre ".$_SESSION["nombre"];
			// vista del Administrador
/*
		// switch para saber el numero del rol para direccionar
			switch($_SESSION["rol"]) {
			case '0':
			// vista del Usuario Normal
				header("Location:vista/vista_usuario.php");
				break;
			case '1':
			// vista del Administrador
				header("Location:vista/index.php");
				break;
			}

*/			if ($_POST['cedula']==$_POST['pass']){
				$alerta ="Hemos observado que aun usa su cedula como clave de acceso, esto es poco seguro y se recomienda su cambio de manera inmediata";
				echo "<script>";
				echo "if(confirm('$alerta')){";
				echo "window.location = 'vista/visPrimerCambio.php';";
				echo "}else{";
				echo "window.location='vista/index.php';}  </script>";
				$objLogin->restart();
			}
			else{
				$objLogin->restart();

				echo "<script> window.location='vista/index.php';  </script>";
			}
		}else{
			$objLogin->id();
			if($arreglo=$objLogin->row()){
				$contclave=$arreglo['cont_cla']+1;
				$objLogin->fallido($contclave);
				if($contclave>='5'){
					$objLogin->excedido($contclave);
					$mensaje = "Disculpe usted ya ha intentado ingresar a esta cuenta de usuario tres veces con una contraseña invalida, por lo tanto estara suspendido por favor dirijase a la opcion olvide contraseña";
					echo "<script>";
					echo "if(confirm('$mensaje'));";
					echo "window.location = 'vista/visOlvidoContrasena.php';";
					echo "</script>";
				}
				else {
					$mensaje = "Error en Nombre de Usuario o Clave";
					echo "<script>";
					echo "if(confirm('$mensaje'));";
					echo "window.location = 'index.php';";
					echo "</script>";

				}

			}
		}
		}
	}

}

?>
