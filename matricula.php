<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>MATRICULA VEHICULOS</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">



<style>
	th, td {
  padding: 10px 30px;
}
</style>
</head>
<body>
<div class="text-center">
  <a href="index.html" class="btn btn-secondary mx-auto btn-block col-sm-2">
    <i class="bi bi-house-door"></i> Home
  </a>
</div>

<?php
	include_once("constantes.php");
	require_once("Recursos/class/class.matricula.php");
	$cn = conectar();
	$matr = new matricula($cn);
	//echo $v->get_list();

	if(isset($_GET['d'])){
	  	
/*     		echo "<pre>";
				print_r($_GET);
			echo "</pre>";*/

	 		$dato = base64_decode($_GET['d']);
			$tmp = explode("/", $dato);
			
	 	
/*			echo "<pre>";
				print_r($tmp);
			echo "</pre>";*/
			
			$op = $tmp[0];
			$id = $tmp[1];
			
			//echo "op = " .$op . "<br>" ;
	    	//echo "id = " .$id . "<br>" ;
			
		//	$dato = base64_decode($id);
		//	echo $dato;exit;
	    	if($op == "det" || $op == "new"){
				echo $matr->get_detail_matricula($id);
				echo $matr->get_form_matricula($id);
			}elseif($op == "act"){
				echo $matr->get_form_matricula($id);
			}elseif($op == "new"){
				echo $matr->get_form_matricula();
			}elseif($op == "del"){
				echo $matr->delete_matricula($id);; // BORRAR TODOS LOS REGISTROS DE LA BASE DE DATOS
			}	
			
	}else{
		
/*			echo "<pre>";
				print_r($_POST);
			echo "</pre>";
		
		if(isset($_POST['Guardar'])){
			echo "<br>PETICION POST ...... <br>";
			echo "<pre>";
				print_r($_POST);
			echo "</pre>";
		}*/

		//PARTE III
		if(isset($_POST['Guardar']) && $_POST['op']=="new"){
				$matr->save_matricula($_POST);
			}
			if(isset($_POST['Guardar']) && $_POST['op']=="act"){
				$matr->update_matricula($_POST);
			}else{
				echo $matr->get_list($_POST);
			}	

		
	}

	//*******************************************************
		function conectar(){
			//echo "<br> CONEXION A LA BASE DE DATOS<br>";
			$c = new mysqli(SERVER,USER,PASS,BD);
			
			if($c->connect_errno) {
				die("Error de conexión: " . $c->mysqli_connect_errno() . ", " . $c->connect_error());
			}
		/*	else{
				echo "La conexión tuvo éxito .......<br><br>";
			}  */
			
			$c->set_charset("utf8");
			return $c;
		}
//**********************************************************

?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>