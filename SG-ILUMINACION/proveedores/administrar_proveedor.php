<?php
//incluye la clase Proveedor y CrudProveedor
require_once('crud_proveedor.php');
require_once('conexion.php');


$crud= new CrudProveedor();
$proveedor =new Proveedor();
$registro = new Proveedor();

//Si el elemento insertar no viene nulo llama al crud e inserta un producto
if(isset($_POST['insertar'])){
    $proveedor->setNombre($_POST['Nombre']);
    $proveedor->setApellidos($_POST['Apellidos']);
    $proveedor->setCorreo($_POST['Correo']);
    $proveedor->setContrasena($_POST['Contrasena']);
    $proveedor->setMarca($_POST['Marca']);

    $crud->insertar($proveedor); 
    $registro=$crud->loginProveedor($_POST['Correo'],$_POST['Contrasena']);

    header('Location: ../proveedores/proveedores.php?id_Proveedor='.$registro->getId());
}   
?>