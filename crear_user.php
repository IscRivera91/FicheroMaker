<?php

/* Example for adding a VPN user */
if (isset($_POST['num_fichas'])) {
	# code...

require('class/api.php');
session_start();

$ip_server = $_SESSION['IP'];
$user_server = $_SESSION['USER'];
$password_server = $_SESSION['PASS'];
$contador = 0;

$abc = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');

// varibles que se reciben por el metodo post 
$num_fichas = $_POST['num_fichas'];
$tiempo = $_POST['tiempo'];
$profile = $_POST['profile'];
$prefijo = $_POST['prefijo'];
// terminan la variable que vienen por el metodo post 
$API = new RouterosAPI();

$API->debug = false;

if ($API->connect($ip_server, $user_server, $password_server)) {


   while ( $contador < $num_fichas) {
   		$codigo = "";
   		for ($i=0; $i < 7 ; $i++) { // esto es para el usuario
			$codigo = $codigo.$abc[rand(0,33)];
			usleep(1800);
		}
		$pass = "";
		for ($i=0; $i < 4 ; $i++) {  // esto es para la contra
			$pass = $pass.$abc[rand(0,33)];
			usleep(1800);
		}
   		$ARRAY = $API->comm("/ip/hotspot/user/add", array(
		      "limit-uptime"     => $tiempo,
		      "name" => $prefijo.$codigo,
		      "profile" => $profile,
		      "password" => $pass,
		      "server"  => "hotspot1",
		   ));

		   $resultados = print_r($ARRAY, true); // $resultados contiene ahora la salida de print_r
		   $cantidad =  strlen($resultados);
		   
		   if ($cantidad < 10) {
		   	// esta parte del if solo se ejecuta si la clave se ingreso al mikrotik de manera correcta 
		   	$contador++;
		   	echo "Usuario->".$prefijo.$codigo."<br> ";
		   }else{
		   	// esta parte de se ejecuta si no se pudo agregar la clave al mikrotik 
		   }	
   }
   
   

   
   

}

}else{
	echo '<script language = javascript>
        self.location = "index.php";
        </script>';
}

?>