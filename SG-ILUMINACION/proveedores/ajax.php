<?php
session_start();
include_once dirname(__FILE__).'/inc/config.php';

//Obtener el ID del vendedor del Url
require ('url.php');
$id_Vendedor_url = url();


//--->Obtener todos los registros > Inicio
if(isset($_GET['call_type']) && $_GET['call_type'] =="get"){
	////Envia la instrucción para consultar los datos
	$q1 = app_db()->Select("select * from producto");
	
	echo json_encode($q1);
}
//--->Obtener todos los registros > Fin

//--->Obtener todos los registros de un vendedor en especifico> Inicio
if(isset($_GET['call_type']) && $_GET['call_type'] =="get_by_id"){
	//Envia la instrucción para consultar los datos en base al ID del vendedor
	$q1 = app_db()->Select("select * from producto where id_Vendedor=" . $id_Vendedor_url);
	
	echo json_encode($q1);
}
//--->Obtener todos los registros de un vendedor en especifico> Fin

//--->Actualizar registro> Inicio
if(isset($_POST['call_type']) && $_POST['call_type'] =="row_entry"){	

	//Obtener los valores del objeto enviado
	$fila_id 		= app_db()->CleanDBData($_POST['fila_id']);
	$Nombre  		= app_db()->CleanDBData($_POST['Nombre']); 
	$Precio  		= app_db()->CleanDBData($_POST['Precio']); 
	$Tipo  			= app_db()->CleanDBData($_POST['Tipo']);
	$Imagen_url  	= app_db()->CleanDBData($_POST['Imagen_url']); 
	$Caracteristicas= app_db()->CleanDBData($_POST['Caracteristicas']); 
	$Descuento  	= app_db()->CleanDBData($_POST['Descuento']);
	$Stock  		= app_db()->CleanDBData($_POST['Stock']);  	
	
	//Instrucción de consulta
	$q1 = app_db()->select("select * from producto where fila_id='$fila_id'");
	if($q1 < 1) {
		echo json_encode(array(
			'status' => 'error', 
			'msg' => 'no se encontraron registros', 
		));
		die();
	}
	else if($q1 > 0) {
		//Asignar el nombre de la tabla
		$strTableName = "producto";
		
		//Asignar los datos a actualizar
		$array_fields = array(
			'Nombre' => $Nombre,
			'Precio' => $Precio,
			'Tipo' => $Tipo,
			'Imagen_url' => $Imagen_url,
			'Caracteristicas' => $Caracteristicas,
			'Descuento' => $Descuento,
			'Stock' => $Stock,
		);
		//Asignar condición
		$array_where = array(    
		  'fila_id' => $fila_id,
		);

		//Envia la instrucción para actualizar los datos
		app_db()->Update($strTableName, $array_fields, $array_where);

		echo json_encode(array(
			'status' => 'success', 
			'msg' => 'registro actualizado', 
		));
		die();
	}
}
//--->Actualizar registro> Fin




//--->Nuevo registro  > Inico
if(isset($_POST['call_type']) && $_POST['call_type'] =="new_row_entry"){	

	//Obtener los valores del objeto enviado
	$fila_id 		= app_db()->CleanDBData($_POST['fila_id']);
	$id_Vendedor  	= app_db()->CleanDBData($_POST['id_Vendedor']); 
	$Nombre  		= app_db()->CleanDBData($_POST['Nombre']); 
	$Precio  		= app_db()->CleanDBData($_POST['Precio']); 
	$Tipo  			= app_db()->CleanDBData($_POST['Tipo']);
	$Imagen_url  	= app_db()->CleanDBData($_POST['Imagen_url']); 
	$Caracteristicas= app_db()->CleanDBData($_POST['Caracteristicas']); 
	$Descuento  	= app_db()->CleanDBData($_POST['Descuento']);
	$Stock  		= app_db()->CleanDBData($_POST['Stock']); 	
	
	//Instrucción de consulta
	$q1 = app_db()->select("select * from producto where fila_id='$fila_id'");
	if($q1 < 1) {
		//Asignar el nombre de la tabla
		$strTableName = "producto";

		//Asignar los datos a ingresar
		$insert_arrays = array
		(
			'fila_id' => $fila_id,
			'id_Vendedor' => $id_Vendedor,
			'Nombre' => $Nombre,
			'Precio' => $Precio,
			'Tipo' => $Tipo,
			'Imagen_url' => $Imagen_url,
			'Caracteristicas' => $Caracteristicas,
			'Descuento' => $Descuento,
			'Stock' => $Stock,
		);

		//Envia la instrucción para ingresar los datos
		app_db()->Insert($strTableName, $insert_arrays);

		echo json_encode(array(
			'status' => 'success', 
			'msg' => 'added new entry', 
		));
		die();
	}	 
}
//--->Nuevo registro  > Fin



//--->Eliminar registro  > Inicio
if(isset($_POST['call_type']) && $_POST['call_type'] =="delete_row_entry"){	

	//Obtener los valores del objeto enviado
	$fila_id 	= app_db()->CleanDBData($_POST['fila_id']);	 
	
	//Instrucción de consulta
	$q1 = app_db()->select("select * from producto where fila_id='$fila_id'");
	if($q1 > 0) {
		//Asignar el nombre de la tabla
		$strTableName = "producto";

		//Asignar condición
		$array_where = array('fila_id' => $fila_id);

		//Envia la instrucción para eliminar el registro
		app_db()->Delete($strTableName,$array_where);

		echo json_encode(array(
			'status' => 'success', 
			'msg' => 'deleted entry', 
		));
		die();
	}	 
}
//--->Eliminar registro  > Fin
