<?php 

session_start();

$user = $_POST['user'];
$pass = $_POST['pass'];
$ip = $_POST['ip'];


require('class/api.php');
$API = new RouterosAPI();
$API->debug = false;
if ($API->connect($ip, $user, $pass)){
	$_SESSION['USER'] = $_POST['user'];
	$_SESSION['PASS'] = $_POST['pass'];
	$_SESSION['IP'] = $_POST['ip'];

	echo '<script language = javascript>
        self.location = "index.php";
        </script>';
}else{
	echo '<script language = javascript>
        self.location = "session.php?error=true";
        </script>';
}


?>
