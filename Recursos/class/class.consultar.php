<?php
class consulta{
	private $id;
	private $fecha;
	private $vehiculo;
	private $agencia;
	private $anio;
	private $con;
	function __construct($cn){
		$this->con = $cn;
	    //echo "EJECUTANDOSE EL CONSTRUCTOR VEHICULO<br><br>";
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
						<td><a  class="btn btn-info btn-responsive" href="consultar.php?d=' . $d_det_final . '">Consultar</a></td>
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
	
//****************************************** NUEVO CODIGO *****************************************

public function get_detail_vehiculo($id){
		$sql = "SELECT ma.id, ma.fecha, v.placa, a.descripcion as agencia, ma.anio
		        FROM vehiculo v, agencia a, matricula ma
				WHERE ma.vehiculo=$id AND ma.vehiculo=v.id AND ma.agencia=a.id;";
		$res = $this->con->query($sql);
		
		// VERIFICA SI EXISTE id
		$num = $res->num_rows;
	if($num == 0){
        $mensaje = "desplegar el detalle del vehiculo con id= ".$id . "<br>";
        echo $this->_message_error($mensaje);
				
    }else{ 
	
    	$html = '';
		while($row = $res->fetch_assoc()){
/*			echo "<br>TUPLA<br>";
		    echo "<pre>";
					print_r($row);
			echo "</pre>";*/
		$html .= '
		<section>
		<div class="banner">
        <div class="container p-5">
          <div class="card mx-3 mt-n5 shadow-lg">

			<div class="card-body ">
		<table align="center"table table-striped gap-3 >
			<tr>
				<th colspan="2"><strong><FONT SIZE=7>DATOS DEL VEHÍCULO - MATRICULA</font></th>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Fecha matricula: </td>
				<td>'. $row['fecha'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Marca: </td>
				<td>'. $row['placa'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Motor: </td>
				<td>'. $row['agencia'] .'</td>
			</tr>
			<tr>
				<td><strong><FONT SIZE=5>Chasis: </td>
				<td>'. $row['anio'] .'</td>
			</tr>																				
		</table>
		</div>
					</div></div></div>

			<section>';
		}
		$html .='<div class="text-center">
  <a href="consultar.php" class="btn btn-primary mx-auto btn-block col-sm-2">
    Regresar</a></div>';
		return $html;
	}	
	
}



//***************************************************************************************	
	
	private function _calculo_matricula($avaluo){
		return number_format(($avaluo * 0.10),2);
	}
	
//***************************************************************************************************************************

	private function _message_error($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>Error al ' . $tipo . 'Favor contactar a .................... </th>
			</tr>
			<tr>
				<th><a class="btn btn-primary col-12" href="consultar.php">Regresar</a></th>
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
				<th><a class="btn btn-primary col-12" href="consultar.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}

//************************************************************************************************************************************************

 
}
?>

