$(document).ready(function($){
    //ajax datos
    var ajax_data=[
        {nombre:"1", precio:"1", cantidad:"1", caract:"1", desc:"1"}, 
        {nombre:"2", precio:"2", cantidad:"2", caract:"2", desc:"2"},
        {nombre:"3", precio:"3", cantidad:"3", caract:"3", desc:"3"},
        {nombre:"4", precio:"4", cantidad:"4", caract:"4", desc:"4"},
    ]

    //Crear un ID random
    var random_id = function(){
        var id_num = Math.random().toString(9).substr(2,3);
        var id_str = Math.random().toString(36).substr(2);
        
        return id_num + id_str;
    }

    //Crear tabla > Inicio
    var tbl = '';
    tbl +='<table class="table table-hover tbl_proveedores">';
        tbl +='<thead>';
            tbl +='<tr>';
            tbl +='<th>Nombre</th>';
            tbl +='<th>Precio</th>';
            tbl +='<th>Cantidad</th>';
            tbl +='<th>Caracteristicas</th>';
            tbl +='<th>Descripción</th>';
            tbl +='<th>Opciones</th>';
            tbl +='</tr>';
        tbl +='</thead>';

        tbl +='<tbody>';
            $.each(ajax_data, function(index, val){
                var fila_id = random_id();

                tbl +='<tr fila_id="'+fila_id+'">';
                    tbl +='<td ><div class="fila_datos" edit_type="click" col_name="nombre">'+val['nombre']+'</div></td>';
                    tbl +='<td ><div class="fila_datos" edit_type="click" col_name="precio">'+val['precio']+'</div></td>';
                    tbl +='<td ><div class="fila_datos" edit_type="click" col_name="cantidad">'+val['cantidad']+'</div></td>';
                    tbl +='<td ><div class="fila_datos" edit_type="click" col_name="caract">'+val['caract']+'</div></td>';
                    tbl +='<td ><div class="fila_datos" edit_type="click" col_name="desc">'+val['desc']+'</div></td>';

                    tbl +='<td>';                
                        tbl +='<span class="btn_editar" > <a href="#" class="btn btn-link " fila_id="'+fila_id+'" > Editar</a> </span>';

                        tbl +='<span class="btn_guardar"> <a href="#" class="btn btn-link"  fila_id="'+fila_id+'">Guardar</a></span>';
                        tbl +='<span class="btn_cancelar"> <a href="#" class="btn btn-link" fila_id="'+fila_id+'">Cancelar</a></span>';
                        tbl +='<span class="btn_eliminar"> <a href="#" class="btn btn-link1 text-danger" fila_id="'+fila_id+'">Eliminar</a></span>';
                    tbl +='</td>';                        
                tbl +='</tr>';
            });
        tbl +='</tbody>';
    tbl +='</table>'	
    //Crear tabla > Fin
    
    //Añadir nueva fila a la tabla
    tbl +='<div class="text-center">';
        tbl +='<span class="btn btn-primary btn_nueva_fila " >Añadir nuevo producto</span>';
    tbl +='<div>';

    //Mostrar datos en la tabla
    $(document).find('.tbl_usuario_datos').html(tbl);

    $(document).find('.btn_guardar').hide();
    $(document).find('.btn_cancelar').hide();
    $(document).find('.btn_eliminar').hide();  


    //Editar > Inicio
    $(document).on('click', '.btn_editar', function(event){
        event.preventDefault();
        var tbl_fila = $(this).closest('tr');

        var fila_id = tbl_fila.attr('fila_id');

        tbl_fila.find('.btn_guardar').show();
        tbl_fila.find('.btn_cancelar').show();
        tbl_fila.find('.btn_eliminar').show();

        tbl_fila.find('.btn_editar').hide(); 

        tbl_fila.find('.fila_datos')
        .attr('contenteditable', 'true')
        .attr('edit_type', 'button')
        .addClass('bg-warning')
        .css('padding','3px')

        tbl_fila.find('.fila_datos').each(function(index, val){  
            $(this).attr('original_entry', $(this).html());
        }); 		
    });
    //Editar > Fin


    //Cancelar > Inicio
    $(document).on('click', '.btn_cancelar', function(event){
        event.preventDefault();

        var tbl_fila = $(this).closest('tr');

        var fila_id = tbl_fila.attr('fila_id');

        tbl_fila.find('.btn_guardar').hide();
        tbl_fila.find('.btn_cancelar').hide();
        tbl_fila.find('.btn_eliminar').hide();

        tbl_fila.find('.btn_editar').show();

        tbl_fila.find('.fila_datos')
        .attr('edit_type', 'click')
        .removeClass('bg-warning')
        .css('padding','') 

        tbl_fila.find('.fila_datos').each(function(index, val){   
            $(this).html( $(this).attr('original_entry') ); 
        });  
    });
    //Cancelar > Fin

    
    //Guardar > Inicio
    $(document).on('click', '.btn_guardar', function(event){
        event.preventDefault();
        var tbl_fila = $(this).closest('tr');

        var fila_id = tbl_fila.attr('fila_id');

        tbl_fila.find('.btn_guardar').hide();
        tbl_fila.find('.btn_cancelar').hide();
        tbl_fila.find('.btn_eliminar').hide();

        tbl_fila.find('.btn_editar').show();

        tbl_fila.find('.fila_datos')
        .attr('edit_type', 'click')
        .removeClass('bg-warning')
        .css('padding','') 

        var arr = {}; 
        tbl_fila.find('.fila_datos').each(function(index, val){   
            var col_name = $(this).attr('col_name');  
            var col_val  =  $(this).html();
            arr[col_name] = col_val;
        });

        $.extend(arr, {fila_id:fila_id});

        $('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>')
    });
    //Guardar > Fin

    //Nueva Fila > Inicio
    $(document).on('click', '.btn_nueva_fila', function(event){
        event.preventDefault();

        var fila_id = random_id();

        var tbl_fila = $(document).find('.tbl_proveedores').find('tr');	 
        var tbl = '';
        tbl +='<tr fila_id="'+fila_id+'">';
            tbl +='<td ><div class="new_fila_datos nombre bg-warning" contenteditable="true" edit_type="click" col_name="nombre"></div></td>';
            tbl +='<td ><div class="new_fila_datos precio bg-warning" contenteditable="true" edit_type="click" col_name="precio"></div></td>';
            tbl +='<td ><div class="new_fila_datos cantidad bg-warning" contenteditable="true" edit_type="click" col_name="cantidad"></div></td>';
            tbl +='<td ><div class="new_fila_datos caract bg-warning" contenteditable="true" edit_type="click" col_name="caract"></div></td>';
            tbl +='<td ><div class="new_fila_datos desc bg-warning" contenteditable="true" edit_type="click" col_name="desc"></div></td>';

            tbl +='<td>';			 
                tbl +='  <a href="#" class="btn btn-link btn_nuevo" fila_id="'+fila_id+'" > Añadir Producto</a>   | ';
                tbl +='  <a href="#" class="btn btn-link1 text-danger btn_eliminar_nueva_entrada" fila_id="'+fila_id+'"> Cancelar</a> ';
            tbl +='</td>';
        tbl +='</tr>';
        tbl_fila.last().after(tbl);

        $(document).find('.tbl_proveedores').find('tr').last().find('.nombre').focus();
    });
    //Nueva Fila > Fin

    //Cancelar Nueva Fila > Inicio
    $(document).on('click', '.btn_eliminar_nueva_entrada', function(event) {
        event.preventDefault();

        $(this).closest('tr').remove();
    });
    //Cancelar Nueva Fila > Fin

    //Mensaje de Validación
    function alert_msg (msg){
        return '<span class="alert_msg text-danger">'+msg+'</span>';
    }

    //Ingresar Nuevos Datos > Inicio
    $(document).on('click', '.btn_nuevo', function(event) {
        event.preventDefault();
		
		var ele_this = $(this);
		var ele = ele_this.closest('tr');
		
		ele.find('.alert_msg').remove();

		var fila_id = $(this).attr('fila_id');

        var nombre = ele.find('.nombre');
		var precio = ele.find('.precio');
		var cantidad = ele.find('.cantidad');
        var caract = ele.find('.caract');
		var desc = ele.find('.desc');

        if(nombre.html() == ""){
			nombre.focus();
			nombre.after(alert_msg('Ingrese el nombre'));
		}
		else if(precio.html() == ""){
			precio.focus();
			precio.after(alert_msg('Ingrese el precio'));
		}
		else if(cantidad.html() == ""){
			cantidad.focus();
			cantidad.after(alert_msg('Ingrese la cantidad'));
		}
        else if(caract.html() == ""){
			caract.focus();
			caract.after(alert_msg('Ingrese las características'));
		}
		else if(desc.html() == ""){
			desc.focus();
			desc.after(alert_msg('Ingrese la descripción'));
		}
        else{
			var data_obj={
				fila_id:fila_id,
				nombre:nombre.html(),
				precio:precio.html(),
				cantidad:cantidad.html(),
                caract:caract.html(),
				desc:desc.html(),
			};	

			ele_this.html('<p class="bg-warning">Please wait....adding your new row</p>');

            ele.find('.fila_datos').each(function(index, val){   
                var col_name = $(this).attr('col_name');  
                var col_val  =  $(this).html();
                arr[col_name] = col_val;
            });

            var tbl = '';
            tbl +='<a href="#" class="btn btn-link btn_editar" fila_id="'+fila_id+'" >Editar</a>';
            tbl +='<a href="#" class="btn btn-link btn_guardar"  fila_id="'+fila_id+'" style="display:none;">Guardar</a>';
            tbl +='<a href="#" class="btn btn-link btn_cancelar" fila_id="'+fila_id+'" style="display:none;">Cancelar</a>';
            tbl +='<a href="#" class="btn btn-link1 text-warning btn_eliminar" fila_id="'+fila_id+'" style="display:none;">Eliminar</a>';


            ele_this.closest('td').html(tbl);
            ele.find('.new_fila_datos').removeClass('bg-warning');
            ele.find('.new_fila_datos').toggleClass('new_fila_datos fila_datos');
            $('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(data_obj, null, 2) +'</pre>')
		}
    });
    //Ingresar Nuevos Datos > Fin

    //Eliminar > Inicio
    $(document).on('click', '.btn_eliminar', function(event) {
        event.preventDefault();

        var ele_this = $(this);
        var fila_id = ele_this.attr('fila_id');
        var data_obj={
            fila_id:fila_id,
        };	
        $('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(data_obj, null, 2) +'</pre>')
        ele_this.closest('tr').css('background','red').slideUp('slow');
	});
    //Eliminar > Fin
});