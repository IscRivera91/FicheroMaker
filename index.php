

<?php 
// probando git
session_start();
  if (!isset($_SESSION['IP']) || $_SESSION['IP'] == ""){
        echo '<script language = javascript>
        self.location = "session.php";
        </script>';
      }else{
      	require('class/api.php');

		$ip_server = $_SESSION['IP'];
		$user_server = $_SESSION['USER'];
		$password_server = $_SESSION['PASS'];

		$API = new RouterosAPI();
		$API->debug = false;
      }




?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Codigos</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>


        

        <div class="container-fluit">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <h1 align="center" class="page-header">Fichero maker by Ricardo Rivera</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            CREAR CLAVES
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="POST" action="crear_user.php">
                                Limite de tiempo: <select name="tiempo" class="form-control">
													  <option value="01:00:00">1 Hora</option>
													  <option value="02:00:00">2 Hora</option>
                                                      <option value="03:00:00">3 Hora</option>
													  <option value="1d 00:00:00">1 Dia</option>
													  <option value="15d 00:00:00">15 Dias</option>
													  <option value="30d 00:00:00">30 Dias</option>
                                                      
												   </select>
                                <br>
                                Profile: 
                                <select name="profile" class="form-control" >
                                    <?php 
                                        if ($API->connect($ip_server, $user_server, $password_server)) { // if que abre la coneccion con el router mikrotik  

                                          $API->write("/ip/hotspot/user/profile/getall",true);
                                          $READ = $API->read(false); //Leemos la respuesta y la mandamos a READ
                                          $ARRAY = $API->parseResponse($READ);
                                          for ($i=0; $i <count($ARRAY) ; $i++) {
                                          //if ($ARRAY[$i]['name'] != "default") {
                                            echo '<option value="'.$ARRAY[$i]["name"].'">'.$ARRAY[$i]["name"].'</option>';
                                           //} 
                                          }
                                        }// fin del if que abre la coneccion con router mikrotik 
                                    ?>
                                </select>
                                <br>
                                Numero de fichas: 
                                <select name="num_fichas" class="form-control">
								  <?php for ($i=1; $i < 501 ; $i++) { 
								  	echo "<option value='".$i."'>".$i." </option>";
								  } ?>
							    </select>
                                <br>
                                Prefijo: <input name="prefijo" required type="text" class="form-control"  placeholder="0HAB">
                                <br>
                                <button type="submit" class="btn btn-default">CREAR</button>
                            </form>


                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>   
        </div>
        <!-- /#page-wrapper -->

    

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
