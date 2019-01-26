<?php 

require('class/api.php');

$ip_server = "192.168.1.64";
$user_server = "api";
$password_server = "api";

$API = new RouterosAPI();
$API->debug = false;


if ($API->connect($ip_server, $user_server, $password_server)) { // if que abre la coneccion con el router mikrotik  

  $API->write("/ip/hotspot/user/profile/getall",true);
  $READ = $API->read(false); //Leemos la respuesta y la mandamos a READ
  $ARRAY = $API->parseResponse($READ);

  for ($i=0; $i <count($ARRAY) ; $i++) {
  //if ($ARRAY[$i]['name'] != "default") {
   	echo $ARRAY[$i]['name']."<br>";
   //} 
  }


}// fin del if que abre la coneccion con router mikrotik 


?>