<?php
session_start();

include_once dirname(__FILE__).'/inc/config.php'; 

//Obtener el ID del vendedor del Url
$_SESSION['id_Ven'] = $_GET['id_Proveedor'];
require ('url.php');
url();

require_once('crud_proveedor.php');
require_once('conexion.php');
$crud= new CrudProveedor();
$proveedor =new Proveedor();

?>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<style>
        .panel-default > .panel-heading-custom {
            background: #E2c219; color: rgb(0, 0, 0);
        }
        .bg {
			background-image: url("../img/bg_proveedores.jpg");
            background-position: center;
			background-repeat: repeat-y;
			background-size: cover;
        }
    </style>

<script type="text/javascript">
	
	//Asignar el ID del vendedor
	const id_Vendedor = <?= json_encode(url()); ?>;
	console.log("id_Vendedor: ", id_Vendedor);

	$(document).ready(function($){ 	 
		
		// ---> Crear tabla > Inicio
		function create_html_table (tbl_datos){
			
			var tbl = '';
			tbl +='<table class="table table-hover tbl_proveedores">';

				// ---> Crear encabezado de tabla > Inicio
				tbl +='<thead>';
					tbl +='<tr>';
					tbl +='<th>Nombre</th>';
					tbl +='<th>Precio</th>';
					tbl +='<th>Tipo</th>';
					tbl +='<th>Imagen_url</th>';
					tbl +='<th>Caracteristicas</th>';
					tbl +='<th>Descuento</th>';
					tbl +='<th>Stock</th>';
					tbl +='<th>Opciones</th>';
					tbl +='</tr>';
				tbl +='</thead>';
				// ---> Crear encabezado de tabla > Fin

				// ---> Crear el cuerpo de la tabla > Inicio
				tbl +='<tbody>';

					// ---> Crear filas del cuerpo de la tabla > Inicio
					$.each(tbl_datos, function(index, val){
						//ID de las filas de la tabla
						var fila_id = val['fila_id'];

						// Recorrer los datos de la fila
						tbl +='<tr fila_id="'+fila_id+'">';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Nombre">'+val['Nombre']+'</div></td>';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Precio">'+val['Precio']+'</div></td>';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Tipo">'+val['Tipo']+'</div></td>';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Imagen_url">'+val['Imagen_url']+'</div></td>';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Caracteristicas">'+val['Caracteristicas']+'</div></td>';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Descuento">'+val['Descuento']+'</div></td>';
							tbl +='<td ><div class="fila_datos" edit_type="click" col_name="Stock">'+val['Stock']+'</div></td>';

							// Opciones para Editar > Inicio
							tbl +='<td>';                
								tbl +='<span class="btn_editar" > <a href="#" class="btn btn-link " fila_id="'+fila_id+'" > Editar</a> </span>';
								// Solo muestran estos botónes si se hace clic en el botón editar
								tbl +='<a href="#" class="btn_guardar btn btn-link"  fila_id="'+fila_id+'"> Guardar </a>';
								tbl +='<a href="#" class="btn_cancelar btn btn-link" fila_id="'+fila_id+'"> Cancelar </a>';
								tbl +='<a href="#" class="btn_eliminar btn btn-link1 text-danger" fila_id="'+fila_id+'"> Eliminar</a>';
							tbl +='</td>';                        
							// Opciones para Editar > Fin
						tbl +='</tr>';
					});
					// ---> Crear filas del cuerpo de la tabla > Fin
				tbl +='</tbody>';
				// ---> Crear el cuerpo de la tabla > Fin
			tbl +='</table>'

			//Añadir nueva fila a la tabla
			tbl +='<div class="text-center">';
				tbl +='<span class="btn btn-primary btn_nueva_fila " >Añadir nuevo producto</span>';
			tbl +='<div>';

			//Mostrar datos en la tabla
			$(document).find('.tbl_usuario_datos').html(tbl);
			
			//Ocultar los botónes de acciones
			$(document).find('.btn_guardar').hide();
			$(document).find('.btn_cancelar').hide();
			$(document).find('.btn_eliminar').hide(); 
		}
		// ---> Crear tabla > Fin


		var ajax_url = "<?php echo APPURL;?>/ajax.php" ;

		//Obtener los registros por ID y crear la tabla
		$.getJSON(ajax_url,{call_type: "get_by_id"},function(data) {
			create_html_table(data);
		});


		// ---> Botón Editar > Inicio
		$(document).on('click', '.btn_editar', function(event) {
			event.preventDefault();
			
			//Obtener toda la fila 
			var tbl_fila = $(this).closest('tr');
			//Obtener el ID de la fila
			var fila_id = tbl_fila.attr('fila_id');
			
			//Mostrar los botónes de las acciones
			tbl_fila.find('.btn_guardar').show();
			tbl_fila.find('.btn_cancelar').show();
			tbl_fila.find('.btn_eliminar').show();
			
			//Ocultar el botón de editar
			tbl_fila.find('.btn_editar').hide(); 

			//Hacer toda la fila editable
			tbl_fila.find('.fila_datos')
			.attr('contenteditable', 'true')
			.attr('edit_type', 'button')
			.addClass('bg-warning')
			.css('padding','3px')

			//Agregar la entrada original
			tbl_fila.find('.fila_datos').each(function(index, val){  
				$(this).attr('original_entry', $(this).html());
			}); 		
		});
		// ---> Botón Editar > Fin


		// ---> Cancelar > Inicio
		$(document).on('click', '.btn_cancelar', function(event){
			event.preventDefault();
			
			//Obtener toda la fila 
			var tbl_fila = $(this).closest('tr');
			//Obtener el ID de la fila
			var fila_id = tbl_fila.attr('fila_id');
			
			//Mostrar los botónes de las acciones
			tbl_fila.find('.btn_guardar').hide();
			tbl_fila.find('.btn_cancelar').hide();
			tbl_fila.find('.btn_eliminar').hide();

			//Ocultar el botón de editar
			tbl_fila.find('.btn_editar').show();

			//Hacer toda la fila editable
			tbl_fila.find('.fila_datos')
			.attr('edit_type', 'click')
			.removeClass('bg-warning')
			.css('padding','')

			//Agregar la entrada original
			tbl_fila.find('.fila_datos').each(function(index, val){   
				$(this).html( $(this).attr('original_entry') ); 
			});  
		});
		// ---> Cancelar > Fin

		
		// ---> Guardar > Inicio
		$(document).on('click', '.btn_guardar', function(event) {
			event.preventDefault();
						
			//Obtener toda la fila 
			var tbl_fila = $(this).closest('tr');
			//Obtener el ID de la fila
			var fila_id = tbl_fila.attr('fila_id');
			
			//Mostrar los botónes de las acciones
			tbl_fila.find('.btn_guardar').hide();
			tbl_fila.find('.btn_cancelar').hide();
			tbl_fila.find('.btn_eliminar').hide();

			//Ocultar el botón de editar
			tbl_fila.find('.btn_editar').show();

			//Hacer toda la fila editable
			tbl_fila.find('.fila_datos')
			.attr('edit_type', 'click')
			.removeClass('bg-warning')
			.css('padding','') 

			// ---> Obtener los datos de la fila > Inicio
			var arr = {}; 
			tbl_fila.find('.fila_datos').each(function(index, val){   
				var col_name = $(this).attr('col_name');  
				var col_val  =  $(this).html();
				arr[col_name] = col_val;
			});
			// ---> Obtener los datos de la fila > Fin

			// Obtener el ID de la fila
			arr['fila_id'] = fila_id;

			// Resultado para Mostrar cambios
			$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>');

			// Agregar tipo de llamada para ajax
			arr['call_type'] = 'row_entry';

			//Llamar a ajax para actualizar el registro de la base de datos 
			$.post(ajax_url, arr, function(data){
				var d1 = JSON.parse(JSON.stringify(data));
				if(d1.status == "error"){
					var msg = ''
					+ '<h3>Hubo un error al intentar actualizar su registro</h3>'
					+'<pre class="bg-danger">'+JSON.stringify(arr, null, 2) +'</pre>'
					+'';

					$('.post_msg').html(msg);
				}
				else if(d1.status == "success"){
					var msg = ''
					+ '<h3>Actualizó con éxito su registro</h3>'
					+'<pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>'
					+'';

					$('.post_msg').html(msg);
				}			
			});
		});
		// ---> Guardar > Fin


		// ---> Nueva Fila > Inicio
		$(document).on('click', '.btn_nueva_fila', function(event) {
			event.preventDefault();

			// Crear ID aleatorio 
			var fila_id = Math.random().toString(36).substr(2);

			// Obtener las filas de la tabla
			var tbl_fila = $(document).find('.tbl_proveedores').find('tr');	 

			// Crear nueva fila > Inicio
			var tbl = '';
			tbl +='<tr fila_id="'+fila_id+'">';
				tbl +='<td ><div class="new_fila_datos Nombre bg-warning" contenteditable="true" edit_type="click" col_name="Nombre"></div></td>';
				tbl +='<td ><div class="new_fila_datos Precio bg-warning" contenteditable="true" edit_type="click" col_name="Precio"></div></td>';
				tbl +='<td ><div class="new_fila_datos Tipo bg-warning" contenteditable="true" edit_type="click" col_name="Tipo"></div></td>';
				tbl +='<td ><div class="new_fila_datos Imagen_url bg-warning" contenteditable="true" edit_type="click" col_name="Imagen_url"></div></td>';
				tbl +='<td ><div class="new_fila_datos Caracteristicas bg-warning" contenteditable="true" edit_type="click" col_name="Caracteristicas"></div></td>';
				tbl +='<td ><div class="new_fila_datos Descuento bg-warning" contenteditable="true" edit_type="click" col_name="Descuento"></div></td>';
				tbl +='<td ><div class="new_fila_datos Stock bg-warning" contenteditable="true" edit_type="click" col_name="Stock"></div></td>';

				tbl +='<td>';			 
					tbl +='  <a href="#" class="btn btn-link btn_nuevo" fila_id="'+fila_id+'" > Añadir Producto</a>   | ';
					tbl +='  <a href="#" class="btn btn-link1 text-danger btn_eliminar_nueva_entrada" fila_id="'+fila_id+'"> Cancelar</a> ';
				tbl +='</td>';
			tbl +='</tr>';
			// Crear nueva fila > Fin

			//Agrear nueva fila al final de la tabla
			tbl_fila.last().after(tbl);

			//Enfocarse en el campo 'Nombre' de la nueva fila
			$(document).find('.tbl_proveedores').find('tr').last().find('.Nombre').focus();
		});
		// ---> Nueva Fila > Fin
		
		// ---> Cancelar Nueva Fila > Inicio
		$(document).on('click', '.btn_eliminar_nueva_entrada', function(event) {
			event.preventDefault();

			//Elimina la entrada nueva en caso de cancelar
			$(this).closest('tr').remove();
		});
		// ---> Cancelar Nueva Fila > Fin

		// ---> Mensaje de Validación
		function alert_msg (msg){
			return '<span class="alert_msg text-danger">'+msg+'</span>';
		}

		// ---> Ingresar Nuevos Datos > Inicio
		$(document).on('click', '.btn_nuevo', function(event) {
			event.preventDefault();
			
			// Obtener la fila
			var ele_this = $(this);
			var ele = ele_this.closest('tr');
			
			ele.find('.alert_msg').remove();

			// Obtener ID de la fila
			var fila_id = $(this).attr('fila_id');

			// Obtner los nombres de los campos
			var Nombre = ele.find('.Nombre');
			var Precio = ele.find('.Precio');
			var Tipo = ele.find('.Tipo');
			var Imagen_url = ele.find('.Imagen_url');
			var Caracteristicas = ele.find('.Caracteristicas');
			var Descuento = ele.find('.Descuento');
			var Stock = ele.find('.Stock');

			// Validar que los campos no esten vacios > Inicio
			if(Nombre.html() == ""){
				Nombre.focus();
				Nombre.after(alert_msg('Ingrese el nombre'));
			}
			else if(Precio.html() == "")
			{
				Precio.focus();
				Precio.after(alert_msg('Ingrese el precio'));
			}
			else if(Tipo.html() == ""){
				Tipo.focus();
				Tipo.after(alert_msg('Ingrese el tipo'));
			}
			else if(Imagen_url.html() == ""){
				Imagen_url.focus();
				Imagen_url.after(alert_msg('Ingrese el url'));
			}
			else if(Caracteristicas.html() == ""){
				Caracteristicas.focus();
				Caracteristicas.after(alert_msg('Ingrese las características'));
			}
			else if(Descuento.html() == ""){
				Descuento.focus();
				Descuento.after(alert_msg('Ingrese el descuento'));
			}
			else if(Stock.html() == ""){
				Stock.focus();
				Stock.after(alert_msg('Ingrese el stock'));
			}
			// Validar que los campos no esten vacios > Fin
			else{
				// Pasar la información de los campos y su llamada a un objeto
				var data_obj=
				{
					call_type: "new_row_entry",
					fila_id: fila_id,
					id_Vendedor: id_Vendedor,
					Nombre: Nombre.html(),
					Precio: Precio.html(),
					Tipo: Tipo.html(),
					Imagen_url: Imagen_url.html(),
					Caracteristicas: Caracteristicas.html(),
					Descuento: Descuento.html(),
					Stock: Stock.html()
				};	
				ele_this.html('<p class="bg-warning">Espere ... agregando su nuevo registro</p>');

				//Llamar a ajax para ingresar el nuevo registro a la base de datos 
				$.post(ajax_url, data_obj, function(data) {
					var d1 = JSON.parse(JSON.stringify(data));

					var tbl = '';
					tbl +='<a href="#" class="btn btn-link btn_editar" fila_id="'+fila_id+'" >Editar</a>';
					tbl +='<a href="#" class="btn btn-link btn_guardar"  fila_id="'+fila_id+'" style="display:none;">Guardar</a>';
					tbl +='<a href="#" class="btn btn-link btn_cancelar" fila_id="'+fila_id+'" style="display:none;">Cancelar</a>';
					tbl +='<a href="#" class="btn btn-link1 text-warning btn_eliminar" fila_id="'+fila_id+'" style="display:none;">Eliminar</a>';

					ele_this.closest('td').html(tbl);
					ele.find('.new_fila_datos').removeClass('bg-warning');
					ele.find('.new_fila_datos').toggleClass('new_fila_datos fila_datos');
				});
			}
		});
		// ---> Ingresar Nuevos Datos > Fin


		// ---> Eliminar > Inicio
		$(document).on('click', '.btn_eliminar', function(event) {
			event.preventDefault();

			// Obtener la fila
			var ele_this = $(this);

			// Obtener ID de la fila
			var fila_id = ele_this.attr('fila_id');
			// Pasar el ID de la fila y su llamada a un objeto
			var data_obj={
				call_type:'delete_row_entry',
				fila_id:fila_id,
			};	
					
			ele_this.html('<p class="bg-warning">Espere ... eliminando su registro</p>')

			//Llamar a ajax para eliminar el registro de la base de datos 
			$.post(ajax_url, data_obj, function(data) { 
				var d1 = JSON.parse(data); 
				if(d1.status == "error"){
					var msg = ''
					+ '<h3>Hubo un error al intentar eliminar su registro</h3>'
					+'<pre class="bg-danger">'+JSON.stringify(data_obj, null, 2) +'</pre>'
					+'';

					$('.post_msg').html(msg);
				}
				else if(d1.status == "success"){
					ele_this.closest('tr').css('background','red').slideUp('slow');				 
				}
			});
		});
		// ---> Eliminar > Fin
	
		
	});
</script>

</head>
<body>
    <header>
        <img style="max-width: 30rem; margin: 2rem 40%;" src="../img/logo.png">
		<div style="text-align:center">
		<?PHP if(isset($_GET['id_Proveedor'])){
			$proveedor=$crud->obtenerProveedor($_GET['id_Proveedor']);
			echo '<h1>Bienvenido/a '.$proveedor->getNombre().' '.$proveedor->getApellidos().'</h1>';
            }else{
                echo '<h1>Bienvenido</h1>';
		}?>
		</div>
		<div style="text-align:center;">
			<a style="font-size:20px; color:red;" href="../clientes/administrar_cliente.php?accion=s">Cerrar sesión</a>
		</div>
	</header>
    <div class="bg">
        <div class="container-fluid" >
            <h1 class="text-center" style="color:white;">Página de Proveedores</h1>
			<div style="padding:10px;"></div>

			<div class="panel panel-default">
			<div style="height: 70px;padding:1px" class="panel-heading panel-heading-custom text-center"><h3> Tabla de Productos </h3> </div>
				<div class="panel-body">
					
					<div class="tbl_usuario_datos"></div>

				</div>
			</div>
        </div>
		<!--
		<div class="container" >
			<div class="panel panel-default">
			<div class="panel-heading"><b>Tabla de Cambios/Actualizaciones</b> </div>
				<div class="panel-body">
					
					<p>Todos los cambios se mostraran abajo</p>
					<div class="post_msg"> </div>

				</div>
			</div>
		</div>
		-->
    </div>
</body>

