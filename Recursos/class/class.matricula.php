
<?php
class matricula{
	
	
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
	private $fecha;
	private $vehiculo;
	private $agencia;
	private $aniov;
	private $con;
	
	function __construct($cn){
		$this->con = $cn;
	}
	

	public function get_form_matricula($id=NULL){
		// Código agregado -- //
	if(($id == NULL) || ($id == 0) ) {
			$this->fecha = date('Y-m-d');
			$this->vehiculo = NULL;
			$this->agencia = NULL;
			$this->anio = NULL;
			
			$flag = 'enabled';
			$op = "new";
			$bandera = 1;
	}else{
			$sql = "SELECT v.id as vehiculo, v.placa, m.descripcion as marca, v.motor, v.chasis, v.combustible, v.anio as aniov, c.descripcion as color, v.foto, v.avaluo
		        FROM vehiculo v, color c, marca m
				WHERE v.id=$id AND v.marca=m.id AND v.color=c.id;";
			$res = $this->con->query($sql);
			$row = $res->fetch_assoc();
            $num = $res->num_rows;
            $bandera = ($num==0) ? 0 : 1;
            
            if(!($bandera)){
                $mensaje = "tratar de actualizar el vehiculo con id= ".$id . "<br>";
                echo $this->_message_error($mensaje);
				
            }else{                
                
				
/*				echo "<br>REGISTRO A MODIFICAR: <br>";
					echo "<pre>";
						print_r($row);
					echo "</pre>";*/
			
		
             // ATRIBUTOS DE LA CLASE VEHICULO   
                $this->fecha = date('Y-m-d');
                $this->vehiculo = $row['vehiculo'];
                $this->agencia = NULL;
                $this->anio = NULL;
                $this->placa = $row['placa'];
                $this->marca = $row['marca'];
                $this->motor = $row['motor'];
                $this->chasis = $row['chasis'];
                $this->combustible = $row['combustible'];
                $this->aniov = $row['aniov'];
                $this->color = $row['color'];
                $this->foto = $row['foto'];
                $this->avaluo = $row['avaluo'];
				
                $flag = "disabled";
				//$flag = "enabled";
                $op = "new"; 
            }
	}
        
	if($bandera){
		$flag = "disabled";
    
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

		<form class=" " name="Form_matricula" method="POST" action="" enctype="multipart/form-data" >
		<input type="hidden" name="id" value="' . $id  . '">
		<input type="hidden" name="op" value="' . $op  . '">
			<table  align="center" >
				<tr>
					<th colspan="2" ><strong><FONT SIZE=7>DATOS MATRICULA.</font></th>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Fecha:</font></strong></td>
					
					<td><input for="floatingTextInput1" class="col-12" type="date" name="fecha" value="' . $this->fecha . '" ' . $flag . '></td>
				</tr>
				<tr class="mx-auto d-done">
					<td><strong><FONT SIZE=5>Vehiculo:</font></strong></td>
					
					<td><input for="floatingTextInput1" class="col-12" type="text" name="vehiculo" value="' . $this->vehiculo . '"' . $flag . '></td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Agencia:</font></strong></td>
					<td> '. $this->_get_combo_db("agencia","id","descripcion","agencia",$this->agencia) . '</td>
				</tr>
				<tr class="mx-auto">
					<td><strong><FONT SIZE=5>Año:</font></strong></td>
					<td>' . $this->_get_combo_anio("anio",2000,$this->anio) . '</td>
				</tr>
				<tr class="mx-auto">
				  <th colspan="2" class="text-center">
				    <input type="submit" name="Guardar" value="GUARDAR" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#guardadoModal">
				    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#canceladoModal">CANCELAR</button>
				  </th>
				</tr>
												
			</table>
			</form>
			</div>
			<div class="modal fade" id="guardadoModal">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                <h4 class="modal-title">Registro guardado</h4>
			            </div>
			            <div class="modal-body">
			                <p>El registro de la matrícula ha sido guardado exitosamente.</p>
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="modal fade" id="canceladoModal">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                <h4 class="modal-title">Operación cancelada</h4>
			            </div>
			            <div class="modal-body">
			                <p>La operación ha sido cancelada.</p>
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
			            </div>
			        </div>
			    </div>
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
				<th colspan="8" class="text-light bg-warning">Lista de Vehículos - Matrícula</th>
			</tr>
			<tr>
				<th colspan="8" ><center><a class="btn btn-success disabled" href="matricula.php?d=' . $d_new_final . '" >Nuevo</a></center></th>
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
			
/*				echo "<br>VARIALE ROW 1 ...... <br>";
				echo "<pre>";
						print_r($row);
				echo "</pre>";*/
			
		    		
				// URL PARA BORRAR
/*				$d_del = "det/" . $row['id'];
				$d_del_final = base64_encode($d_del);*/
				
				// URL PARA ACTUALIZAR
/*				$d_act = "act/" . $row['id'];
				$d_act_final = base64_encode($d_act);*/
				
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
						<td><a class="btn btn-primary btn-responsive " href=".php?d=' . $d_det_final . '">Matricular</a></td>
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
	
	private function _get_combo_anio($nombre,$anio_inicial,$defecto=NULL){
		$html = '<select class="form-select" size="1" style="text-align:center;" name="' . $nombre . '">';
		$anio_actual = date('Y');
		for($i=$anio_inicial;$i<=$anio_actual;$i++){
			$html .= ($defecto == $i)? '<option  class="form-select" size="1" style="text-align:center;"value="' . $i . '" selected>' . $i . '</option>' . "\n":'<option value="' . $i . '">' . $i . '</option>' . "\n";
		}
		$html .= '</select>';
		return $html;
	}
	
	
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

public function get_detail_matricula($id){
		$sql = "SELECT v.placa, m.descripcion as marca, v.motor, v.chasis, v.combustible, v.anio, c.descripcion as color, v.foto, v.avaluo  
				FROM vehiculo v, color c, marca m 
				WHERE v.id=$id AND v.marca=m.id AND v.color=c.id;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		// VERIFICA SI EXISTE id
		$num = $res->num_rows;
        
	if($num == 0){
        $mensaje = "desplegar el detalle de la matricula con id= ".$id . "<br>";
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
		</table>
		</div>
					</div></div></div>

			<section>
		';
		
		return $html;
	}	
	
}


	public function delete_matricula($id){
		
/*		$mensaje = "PROXIMAMENTE SE ELIMINARA el vehiculo con id= ".$id . "<br>";
        echo $this->_message_error($mensaje);*/
		
	   
		$sql = "DELETE FROM matricula WHERE id=$id;";
		if($this->con->query($sql)){
			echo $this->_message_ok("eliminó");
		}else{
			echo $this->_message_error("eliminar<br>");
		}
   		
	}

	public function update_matricula(){
		$this->id = $_POST['id'];
		$this->fecha = $_POST['fecha'];
		$this->vehiculo = $_POST['vehiculo'];
		$this->agencia = $_POST['agencia'];
		$this->anio = $_POST['anio'];
		$sql = "UPDATE matricula SET fecha='$this->fecha',
						vehiculo=$this->vehiculo,
						agencia=$this->chasis,
						anio='$this->anio'
	WHERE id=$this->id;";

	echo $sql;
		if($this->con->query($sql)){
			echo $this->_message_ok("actualizó");
		}else{
			echo $this->_message_error("actualizar<br>");
		}
	}

	public function save_matricula(){
		$this->fecha = date('Y-m-d');
		$this->vehiculo = $_POST['id'];
		$this->agencia = $_POST['agencia'];
		$this->anio = $_POST['anio'];

		$sql = "INSERT INTO matricula VALUES (NULL,'$this->fecha', $this->vehiculo, $this->agencia, '$this->anio');";
		//echo $sql;
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
				<th><a class="btn btn-primary col-12" href="matricula.php">Regresar</a></th>
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
				<th><a class="btn btn-primary col-12" href="matricula.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}

//************************************************************************************************************************************************
}
?>

