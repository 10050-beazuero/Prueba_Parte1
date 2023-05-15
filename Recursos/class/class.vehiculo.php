<?php
class vehiculo{
	
	
	private $id;
	private $placa;
	private $marca;
	private $motor;
	private $chasis;
	private $combustible;
	private $anio;
	private $color;
	private $foto;
	private $avaluo;
	private $con;
	
	function __construct($cn){
		$this->con = $cn;
	    //echo "EJECUTANDOSE EL CONSTRUCTOR VEHICULO<br><br>";
	}
	

	public function get_form($id=NULL){
		// Código agregado -- //
	if(($id == NULL) || ($id == 0) ) {
			$this->placa = NULL;
			$this->marca = NULL;
			$this->motor = NULL;
			$this->chasis = NULL;
			$this->combustible = NULL;
			$this->anio = NULL;
			$this->color = NULL;
			$this->foto = NULL;
			$this->avaluo =NULL;
			
			$flag = 'enabled';
			$op = "new";
			$bandera = 1;
	}else{
			$sql = "SELECT * FROM vehiculo WHERE id=$id;";
			$res = $this->con->query($sql);
			$row = $res->fetch_assoc();
            $num = $res->num_rows;
            $bandera = ($num==0) ? 0 : 1;
            
            if(!($bandera)){
                $mensaje = "tratar de actualizar el vehiculo con id= ".$id . "<br>";
                echo $this->_message_error($mensaje);
				
            }else{                
                
				
				/*echo "<br>REGISTRO A MODIFICAR: <br>";
					echo "<pre>";
						print_r($row);
					echo "</pre>";*/
			
		
             // ATRIBUTOS DE LA CLASE VEHICULO   
                $this->placa = $row['placa'];
                $this->marca = $row['marca'];
                $this->motor = $row['motor'];
                $this->chasis = $row['chasis'];
                $this->combustible = $row['combustible'];
                $this->anio = $row['anio'];
                $this->color = $row['color'];
                $this->foto = $row['foto'];
                $this->avaluo = $row['avaluo'];
				
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

		<form class=" " name="Form_vehiculo" method="POST" action="vehiculo.php" enctype="multipart/form-data" >
		<input type="hidden" name="id" value="' . $id  . '">
		<input type="hidden" name="op" value="' . $op  . '">
			<table  align="center"table table-striped gap-3 >
				<tr>
					<th colspan="2" ><strong><FONT SIZE=7>DATOS VEHÍCULO</font></th>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Placa:</font></strong></td>
					
					<td><input for="floatingTextInput1" class="col-12" type="text" name="placa" value="' . $this->placa . '"></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Marca:</font></strong></td>
					<td> '. $this->_get_combo_db("marca","id","descripcion","marca",$this->marca) . '</td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Motor:</font></strong></td>
					<td><input type="text"  for="floatingTextInput1"  class="col-12" name="motor" value="' . $this->motor . '"></td>
				</tr>	
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Chasis:</font></strong></td>
					<td><input type="text" size="15"  for="floatingTextInput1" class="col-12" name="chasis" value="' . $this->chasis . '"></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Combustible:</font></strong></td>
					<td>' . $this->_get_radio($combustibles, "combustible",$this->combustible) . '</td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Año:</font></strong></td>
					<td>' . $this->_get_combo_anio("anio",1950,$this->anio) . '</td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Color:</font></strong></td>
					<td>' . $this->_get_combo_db("color","id","descripcion","color", $this->color) . '</td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Foto:</font></strong></td>
					<td><input type="file" name="foto" class="col-12"' . $flag . '></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Avalúo:</font></strong></td>
					<td><input for="floatingTextInput1" class="col-12" type="text"  name="avaluo" value="' . $this->avaluo . '" ' . $flag . '></td>
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
				<th colspan="8" class="text-light bg-warning">Lista de Vehículos</th>
			</tr>
			<tr>
				<th colspan="8" ><center><a class="btn btn-success" href="vehiculo.php?d=' . $d_new_final . '" ><i class="bi bi-file-earmark-plus"></i>Nuevo</a></center></th>
			</tr>

			<tr class="table-active thead-dark" >
				<th>Placa</th>
				<th>Marca</th>
				<th>Color</th>
				<th>Año</th>
				<th>Avalúo</th>
				<th colspan="3">Acciones</th>
			</tr>

			
			</div>
			</div>
			</div>';
		$sql = "SELECT v.id, v.placa, m.descripcion as marca, c.descripcion as color, v.anio, v.avaluo  
		        FROM vehiculo v, color c, marca m 
				WHERE v.marca=m.id AND v.color=c.id;";	
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
						<td>' . $row['placa'] . '</td>
						<td>' . $row['marca'] . '</td>
						<td>' . $row['color'] . '</td>
						<td>' . $row['anio'] . '</td>
						<td>' . $row['avaluo'] . '</td>
						<td><a class="btn btn-danger btn-responsive " href="vehiculo.php?d=' . $d_del_final . '"><i class="bi bi-trash"></i>Borrar</a></td>
						<td><a  class="btn btn-warning btn-responsive" href="vehiculo.php?d=' . $d_act_final . '"><i class="bi bi-pencil-square"></i>Actualizar</a></td>
						<td><a  class="btn btn-info btn-responsive" href="vehiculo.php?d=' . $d_det_final . '"><i class="bi bi-eye"></i>Detalle</a></td>
					</tr>
					</tbody>
					';
			 
		    }
		}else{
			$mensaje = "Tabla Vehiculo" . "<br>";
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
		
		/*
			echo "<br>VARIABLE ROW <br>";
					echo "<pre>";
						print_r($row);
					echo "</pre>";
		*/	
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

public function get_detail_vehiculo($id){
		$sql = "SELECT v.placa, m.descripcion as marca, v.motor, v.chasis, v.combustible, v.anio, c.descripcion as color, v.foto, v.avaluo  
				FROM vehiculo v, color c, marca m 
				WHERE v.id=$id AND v.marca=m.id AND v.color=c.id;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		// VERIFICA SI EXISTE id
		$num = $res->num_rows;
        
	if($num == 0){
        $mensaje = "desplegar el detalle del vehiculo con id= ".$id . "<br>";
        echo $this->_message_error($mensaje);
				
    }else{ 
	
/*	    echo "<br>TUPLA<br>";
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
				<th colspan="2"><strong><FONT SIZE=7>DATOS DEL VEHÍCULO</font></th>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Placa: </td>
				<td>'. $row['placa'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Marca: </td>
				<td>'. $row['marca'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Motor: </td>
				<td>'. $row['motor'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Chasis: </td>
				<td>'. $row['chasis'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Combustible: </td>
				<td>'. $row['combustible'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Anio: </td>
				<td>'. $row['anio'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Color: </td>
				<td>'. $row['color'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Avalúo: </td>
				<th>$'. $row['avaluo'] .' USD</th>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Valor Matrícula: </td>
				<th>$'. $this->_calculo_matricula($row['avaluo']) .' USD</th>
			</tr>			
			<tr>
				<th colspan="2"><center><img src="Recursos/img/' . $row['foto'] . '" width="300px"/></center></th>
			</tr>	
			<tr>
				<th colspan="2"><a class="btn btn-primary col-12 " href="vehiculo.php">Regresar</a></th>
			</tr>																						
		</table>
		</div>
					</div></div></div>

			<section>
		';
		
		return $html;
	}	
	
}


	public function delete_vehiculo($id){
		
/*		$mensaje = "PROXIMAMENTE SE ELIMINARA el vehiculo con id= ".$id . "<br>";
        echo $this->_message_error($mensaje);*/
		
	   
		$sql = "DELETE FROM vehiculo WHERE id=$id;";
		if($this->con->query($sql)){
			echo $this->_message_ok("eliminó");
		}else{
			echo $this->_message_error("eliminar<br>");
		}
   		
	}

	public function update_vehiculo($datos){
		$this->id = $datos['id'];
		$this->placa = $datos['placa'];
		$this->marca = $datos['marca'];
		$this->motor = $datos['motor'];
		$this->chasis = $datos['chasis'];
		$this->combustible = $datos['combustible'];
		$this->anio = $datos['anio'];
		$this->color = $datos['color'];
		$sql = "UPDATE vehiculo SET placa='$this->placa',
						marca=$this->marca,
						motor='$this->motor',
						chasis='$this->chasis',
						combustible='$this->combustible',
						anio='$this->anio',
						color=$this->color
	WHERE id=$this->id;";

	echo $sql;
		if($this->con->query($sql)){
			echo $this->_message_ok("actualizó");
		}else{
			echo $this->_message_error("actualizar<br>");
		}
	}

	public function save_vehiculo(){
		$this->placa = $_POST['placa'];
		$this->marca = $_POST['marca'];
		$this->motor = $_POST['motor'];
		$this->chasis = $_POST['chasis'];
		$this->combustible = $_POST['combustible'];
		$this->anio = $_POST['anio'];
		$this->color = $_POST['color'];
		$this->avaluo = $_POST['avaluo'];
		echo "<br>FILES<br>";
	    echo "<pre>";
				print_r($_FILES);
		echo "</pre>";
		$this->foto = $this->_get_name_file($_FILES['foto']['name'],12);;
		$path = "Recursos/img/" . $this->foto;
		if(!move_uploaded_file($_FILES['foto']['tmp_name'],$path)){
			$mensaje = "Cargar la imagen";
			echo $this->_message_error($mensaje);
			exit;
		}
		$sql = "INSERT INTO vehiculo VALUES (NULL,'$this->placa', $this->marca, '$this->motor', '$this->chasis', '$this->combustible', '$this->anio', $this->color,'$this->foto',$this->avaluo);";
		echo $sql;
		$res = $this->con->query($sql);

		if($res){
			echo $this->_message_ok("anadir");
		}else{
			echo $this->_message_error("agrego<br>");
		}
	}


	
//***************************************************************************************	
	
	private function _calculo_matricula($avaluo){
		return number_format(($avaluo * 0.10),2);
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
				<th><a class="btn btn-primary col-12" href="vehiculo.php">Regresar</a></th>
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
				<th><a class="btn btn-primary col-12" href="vehiculo.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}

//************************************************************************************************************************************************

 
}
?>

