<?php
//incluye la clase Producto y CrudProducto
require_once('crud_producto.php');
require_once('producto.php');

$crud= new CrudProducto();
$producto =new Producto();

//Si el elemento insertar no viene nulo llama al crud e inserta un producto
if(isset($_POST['insertar'])){
    $producto->setNombre($_POST['Nombre']);
    $producto->setPrecio($_POST['Precio']);
    $producto->setTipo($_POST['Tipo']);
    $producto->setCaracteristicas($_POST['Caracteristicas']);
    $producto->setDescuento($_POST['Descuento']);
    $producto->setStock($_POST['Stock']);

    $crud->insertar($producto); 
}elseif(isset($_POST['actualizar'])) {
    $producto->setId($_POST['id_Producto']);
    $producto->setNombre($_POST['Nombre']);
    $producto->setPrecio($_POST['Precio']);
    $producto->setTipo($_POST['Tipo']);
    $producto->setCaracteristicas($_POST['Caracteristicas']);
    $producto->setDescuento($_POST['Descuento']);
    $producto->setStock($_POST['Stock']);
    
    $crud->actualizar($producto);
}elseif($_GET['accion']=='e'){
    $crud->eliminar($_GET['id_Producto']);
}   
?>