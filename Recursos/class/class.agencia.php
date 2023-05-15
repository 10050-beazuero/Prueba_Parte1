<?php
class agencia{
	
	
	private $id;
	private $descripcion;
	private $direccion;
	private $telefono;
	private $foto;
	private $horario_inicio;
	private $horario_finalizacion;
	private $con;
	
	function __construct($cn){
		$this->con = $cn;
	    //echo "EJECUTANDOSE EL CONSTRUCTOR AGENCIA<br><br>";
	}
	

	public function get_form_agencia($id=NULL){
		// Código agregado -- //
	if(($id == NULL) || ($id == 0) ) {
			$this->descripcion = NULL;
			$this->direccion = NULL;
			$this->telefono = NULL;
			$this->foto = NULL;
			$this->horario_inicio = NULL;
			$this->horario_finalizacion = NULL;
			
			$flag = 'enabled';
			$op = "new";
			$bandera = 1;
	}else{
			$sql = "SELECT * FROM agencia WHERE id=$id;";
			$res = $this->con->query($sql);
			$row = $res->fetch_assoc();
            $num = $res->num_rows;
            $bandera = ($num==0) ? 0 : 1;
            
            if(!($bandera)){
                $mensaje = "tratar de actualizar la agencia con id= ".$id . "<br>";
                echo $this->_message_error($mensaje);
				
            }else{                
                
				
				/*echo "<br>REGISTRO A MODIFICAR: <br>";
					echo "<pre>";
						print_r($row);
					echo "</pre>";*/
			
		
             // ATRIBUTOS DE LA CLASE AGENCIA 
                $this->descripcion = $row['descripcion'];
                $this->direccion = $row['direccion'];
                $this->telefono = $row['telefono'];
                $this->foto = $row['foto'];
                $this->horario_inicio = $row['horario_inicio'];
                $this->horario_finalizacion = $row['horario_finalizacion'];
				
                $flag = "disabled";
				//$flag = "enabled";
                $op = "act"; 
            }
	}
        
	if($bandera){
    
		$combustibles = ["Gasolina",
						 "Diesel",
						 "Eléctrico"
						 ];
		$html = '
		<section>
		<div class="banner">
        <div class="container p-5">
          <div class="card mx-3 mt-n5 shadow-lg">

		

		<div class="card-body ">

		<form class=" " name="Form_agencia" method="POST" action="agencia.php" enctype="multipart/form-data" >
		<input type="hidden" name="id" value="' . $id  . '">
		<input type="hidden" name="op" value="' . $op  . '">
			<table  align="center"table table-striped gap-3 >
				<tr>
					<th colspan="2" ><strong><FONT SIZE=7>DATOS AGENCIA</font></th>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Descripcion:</font></strong></td>
					<td> '. $this->_get_combo_db("agencia","descripcion","descripcion","descripcion",$this->descripcion) . '</td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Direccion:</font></strong></td>
					<td><input type="text"  for="floatingTextInput1"  class="col-12" name="direccion" value="' . $this->direccion . '"></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Telefono:</font></strong></td>
					<td><input type="number"  for="floatingTextInput1"  class="col-12" name="telefono" value="' . $this->telefono . '"></td>
				</tr>	
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Foto:</font></strong></td>
					<td><input type="file" name="foto" class="col-12"' . $flag . '></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Horario Inicio:</font></strong></td>
					<td><input type="date"  for="floatingTextInput1"  class="col-12" name="horario_inicio" value="' . $this->horario_inicio . '"></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Horario Fin:</font></strong></td>
					<td><input type="date"  for="floatingTextInput1"  class="col-12" name="horario_finalizacion" value="' . $this->horario_finalizacion . '"></td>
				</tr>
				<tr class="mx-auto">
					<th colspan="2"><input type="submit" name="Guardar" value="GUARDAR"  class="btn btn-primary col-12 "></th>
				</tr>												
			</table>
			</div>

			</div></div></div>

			<section>
			';
		return $html;
		}
	}
	
	
	
	public function get_list(){
		$d_new = "new/0";                           //Línea agregada
        $d_new_final = base64_encode($d_new);       //Línea agregada
				
		$html = ' 

		<div class="container-striped container p-5 " >
		<div class="row  justify-content-center">
			<div class=" text-center ">
		<table class="table table-dark" align="center" style="text-align:center;" >
			<tr>
				<th colspan="8" class="text-light bg-warning">Lista de Agencias</th>
			</tr>
			<tr>
				<th colspan="8" ><center><a class="btn btn-success" href="agencia.php?d=' . $d_new_final . '" ><i class="bi bi-file-earmark-plus"></i>Nuevo</a></center></th>
			</tr>

			<tr class="table-active thead-dark" >
				<th>Descripcion</th>
				<th>Direccion</th>
				<th>Horario inicio</th>
				<th>Horario fin</th>
				<th colspan="3">Acciones</th>
			</tr>

			
			</div>
			</div>
			</div>';
		$sql = "SELECT id, descripcion, direccion, horario_inicio, horario_finalizacion FROM agencia;";	
		$res = $this->con->query($sql);
		
		
		
		// VERIFICA si existe TUPLAS EN EJECUCION DEL Query
		$num = $res->num_rows;
        if($num != 0){
		
		    while($row = $res->fetch_assoc()){
			/*
				echo "<br>VARIALE ROW ...... <br>";
				echo "<pre>";
						print_r($row);
				echo "</pre>";
			*/
		    		
				// URL PARA BORRAR
				$d_del = "del/" . $row['id'];
				$d_del_final = base64_encode($d_del);
				
				// URL PARA ACTUALIZAR
				$d_act = "act/" . $row['id'];
				$d_act_final = base64_encode($d_act);
				
				// URL PARA EL DETALLE
				$d_det = "det/" . $row['id'];
				$d_det_final = base64_encode($d_det);	
				
				$html .= '
				<tbody>

					<tr>
						<td>' . $row['descripcion'] . '</td>
						<td>' . $row['direccion'] . '</td>
						<td>' . $row['horario_inicio'] . '</td>
						<td>' . $row['horario_finalizacion'] . '</td>
						<td><a class="btn btn-danger btn-responsive " href="agencia.php?d=' . $d_del_final . '"><i class="bi bi-trash"></i>Borrar</a></td>
						<td><a  class="btn btn-warning btn-responsive" href="agencia.php?d=' . $d_act_final . '"><i class="bi bi-pencil-square"></i>Actualizar</a></td>
						<td><a  class="btn btn-info btn-responsive" href="agencia.php?d=' . $d_det_final . '"><i class="bi bi-eye"></i>Detalle</a></td>
					</tr>
					</tbody>
					';
			 
		    }
		}else{
			$mensaje = "Tabla Agencias" . "<br>";
            echo $this->_message_BD_Vacia($mensaje);
			echo "<br><br><br>";
		}
		$html .= '</table>';
		return $html;
		
	}
	
	
//********************************************************************************************************
	/*
	 $tabla es la tabla de la base de datos
	 $valor es el nombre del campo que utilizaremos como valor del option
	 $etiqueta es nombre del campo que utilizaremos como etiqueta del option
	 $nombre es el nombre del campo tipo combo box (select)
	 * $defecto es el valor para que cargue el combo por defecto
	 */ 
	 
	 // _get_combo_db("marca","id","descripcion","marca",$this->marca)
	 // _get_combo_db("color","id","descripcion","color", $this->color)
	 
	 /*Aquí se agregó el parámetro:  $defecto*/
	private function _get_combo_db($tabla,$valor,$etiqueta,$nombre,$defecto=NULL){
		$html = '<select class="form-select" size="1" style="text-align:center;" name="' . $nombre . '">';
		$sql = "SELECT $valor,$etiqueta FROM $tabla;";
		$res = $this->con->query($sql);
		//$num = $res->num_rows;
		
			
		while($row = $res->fetch_assoc()){
		
		
			/*echo "<br>VARIABLE ROW <br>";
					echo "<pre>";
						print_r($row);
					echo "</pre>";*/
			
			$html .= ($defecto == $row[$valor])?'<option value="' . $row[$valor] . '" selected>' . $row[$etiqueta] . '</option>' . "\n" : '<option value="' . $row[$valor] . '">' . $row[$etiqueta] . '</option>' . "\n";
		}
		$html .= '</select>';
		return $html;
	}
	
	//_get_combo_anio("anio",1950,$this->anio)
	/*Aquí se agregó el parámetro:  $defecto*/
	private function _get_combo_anio($nombre,$anio_inicial,$defecto=NULL){
		$html = '<select class="form-select" size="1" style="text-align:center;" name="' . $nombre . '">';
		$anio_actual = date('Y');
		for($i=$anio_inicial;$i<=$anio_actual;$i++){
			$html .= ($defecto == $i)? '<option  class="form-select" size="1" style="text-align:center;"value="' . $i . '" selected>' . $i . '</option>' . "\n":'<option value="' . $i . '">' . $i . '</option>' . "\n";
		}
		$html .= '</select>';
		return $html;
	}
	
	
	//_get_radio($combustibles, "combustible",$this->combustible) 
	/*Aquí se agregó el parámetro:  $defecto*/
	private function _get_radio($arreglo,$nombre,$defecto=NULL){
		$html = '
		<table border=0 align="left">';
		foreach($arreglo as $etiqueta){
			$html .= '
			<tr>
				<td>' . $etiqueta . '</td>
				<td>';
				$html .= ($defecto == $etiqueta)? '<input type="radio" value="' . $etiqueta . '" name="' . $nombre . '" checked/></td>':'<input type="radio" value="' . $etiqueta . '" name="' . $nombre . '"/></td>';
			
			$html .= '</tr>';
		}
		$html .= '</table>';
		return $html;
	}
	
	
//****************************************** NUEVO CODIGO *****************************************

public function get_detail_agencia($id){
		$sql = "SELECT * FROM agencia WHERE agencia.id = $id;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		// VERIFICA SI EXISTE id
		$num = $res->num_rows;
        
	if($num == 0){
        $mensaje = "desplegar el detalle del la agencia con id= ".$id . "<br>";
        echo $this->_message_error($mensaje);
				
    }else{ 
	
	    /*echo "<br>TUPLA<br>";
	    echo "<pre>";
				print_r($row);
		echo "</pre>";*/
	
		$html = '
				<section>
		<div class="banner">
        <div class="container p-5">
          <div class="card mx-3 mt-n5 shadow-lg">

			<div class="card-body ">
		<table align="center"table table-striped gap-3 >
			<tr>
				<th colspan="2"><strong><FONT SIZE=7>DATOS DE LA AGENCIA</font></th>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Descripcion: </td>
				<td>'. $row['descripcion'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Direccion: </td>
				<td>'. $row['direccion'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Telefono: </td>
				<td>'. $row['telefono'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Horario Inicio: </td>
				<td>'. $row['horario_inicio'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Horario Fin: </td>
				<td>'. $row['horario_finalizacion'] .'</td>
			</tr>			
			<tr>
				<th colspan="2"><center><img src="Recursos/img/' . $row['foto'] . '" width="300px"/></center></th>
			</tr>	
			<tr>
				<th colspan="2"><a class="btn btn-primary col-12 " href="agencia.php">Regresar</a></th>
			</tr>																						
		</table>
		</div>
					</div></div></div>

			<section>
		';
		
		return $html;
	}	
	
}


	public function delete_agencia($id){
		
/*		$mensaje = "PROXIMAMENTE SE ELIMINARA la agencia con id= ".$id . "<br>";
        echo $this->_message_error($mensaje);*/
		
	   
		$sql = "DELETE FROM agencia WHERE id=$id;";
		echo $sql;
		if($this->con->query($sql)){
			echo $this->_message_ok("eliminó");
		}else{
			echo $this->_message_error("eliminar<br>");
		}
   		
	}

	public function update_agencia(){
		$this->id = $_POST['id'];
		$this->descripcion = $_POST['descripcion'];
		$this->direccion = $_POST['direccion'];
		$this->telefono = $_POST['telefono'];
		$this->horario_inicio = $_POST['horario_inicio'];
		$this->horario_finalizacion = $_POST['horario_finalizacion'];
		$sql = "UPDATE agencia SET descripcion='$this->descripcion',
						direccion='$this->direccion',
						telefono=$this->telefono,
						horario_inicio='$this->horario_inicio',
						horario_finalizacion='$this->horario_finalizacion'
	WHERE id=$this->id;";

	echo $sql;
		if($this->con->query($sql)){
			echo $this->_message_ok("actualizó");
		}else{
			echo $this->_message_error("actualizar<br>");
		}
	}

	public function save_agencia(){
		$this->descripcion = $_POST['descripcion'];
		$this->direccion = $_POST['direccion'];
		$this->telefono = $_POST['telefono'];
		$this->horario_inicio = $_POST['horario_inicio'];
		$this->horario_finalizacion = $_POST['horario_finalizacion'];
/*		echo "<br>FILES<br>";
	    echo "<pre>";
				print_r($_FILES);
		echo "</pre>";*/
		$this->foto = $this->_get_name_file($_FILES['foto']['name'],12);;
		$path = "Recursos/img/" . $this->foto;
		if(!move_uploaded_file($_FILES['foto']['tmp_name'],$path)){
			$mensaje = "Cargar la imagen";
			echo $this->_message_error($mensaje);
			exit;
		}
		$sql = "INSERT INTO agencia VALUES (NULL,'$this->descripcion', '$this->direccion', $this->telefono, '$this->foto', '$this->horario_inicio', '$this->horario_finalizacion');";
		echo $sql;
		$res = $this->con->query($sql);

		if($res){
			echo $this->_message_ok("anadir");
		}else{
			echo $this->_message_error("agrego<br>");
		}
	}
	
	
//***************************************************************************************************************************

	private function _get_name_file($nombre_original, $tamanio){
		$tmp = explode(".",$nombre_original); //Divido el nombre por el punto y guardo en un arreglo
		$numElm = count($tmp); //cuento el número de elemetos del arreglo
		$ext = $tmp[$numElm-1]; //Extraer la última posición del arreglo.
		$cadena = "";
			for($i=1;$i<=$tamanio;$i++){
				$c = rand(65,122);
				if(($c >= 91) && ($c <=96)){
					$c = NULL;
					 $i--;
				 }else{
					$cadena .= chr($c);
				}
			}
		return $cadena . "." . $ext;
	}
	
	private function _message_error($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>Error al ' . $tipo . 'Favor contactar a .................... </th>
			</tr>
			<tr>
				<th><a class="btn btn-primary col-12" href="agencia.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
	
	
	private function _message_BD_Vacia($tipo){
	   $html = '
		<table border="0" align="center">
			<tr>
				<th> NO existen registros en la ' . $tipo . 'Favor contactar a .................... </th>
			</tr>
	
		</table>';
		return $html;
	
	
	}
	
	private function _message_ok($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>El registro se  ' . $tipo . ' correctamente</th>
			</tr>
			<tr>
				<th><a class="btn btn-primary col-12" href="agencia.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}

//************************************************************************************************************************************************

 
}
?>

