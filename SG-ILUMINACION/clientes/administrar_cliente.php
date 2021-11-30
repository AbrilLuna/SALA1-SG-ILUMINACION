<?php
//incluye la clase Cliente, CrudCliente
require_once('crud_cliente.php');
require_once('cliente.php');

require_once('../proveedores/crud_proveedor.php');

//inicio de sesion
session_start();

$crud= new CrudCliente();
$cliente =new Cliente();
$crudP=new CrudProveedor;
$proveedor=new Proveedor;

//Si el elemento insertar no viene nulo llama al crud e inserta un producto
if(isset($_POST['insertar'])){
    $cliente->setNombre($_POST['Nombre']);
    $cliente->setApellidos($_POST['Apellidos']);
    $cliente->setCorreo($_POST['Correo']);
    $cliente->setContrasena($_POST['Contrasena']);

    $crud->insertar($cliente); 
    $cliente=$crud->obtenerUsuario($_POST['Correo'],$_POST['Contrasena']);

    header('Location: ../index.php?id_Usuario='.$cliente->getId());

}elseif(isset($_POST['ingresar'])){
    $cliente=$crud->obtenerUsuario($_POST['usuario'], $_POST['password']);
    $proveedor=$crudP->loginProveedor($_POST['usuario'], $_POST['password']);
    //Si el id del objeto retornado no es null, quiere decir que encontro el registro en la base de datos
    if($cliente->getId()!=NULL){
        $_SESSION['usuario']=$cliente; //Si el cliente existe crea la sesion de usuario
        header('Location: ../index.php?id_Usuario='.$cliente->getId());
    }elseif($proveedor->getId()!=NULL){
        $_SESSION['usuario']=$proveedor; //Si el proveedor existe crea la sesion de usuario
        header('Location: ../proveedores/proveedores.php?id_Proveedor='.$proveedor->getId());
    }else{
        header('Location: ../login/error.php?mensaje=Los datos ingresados son incorrectos');
    }

}elseif(isset($_POST['actualizar'])) {
    $cliente->setId($_POST['id_Usuario']);
    $cliente->setNombre($_POST['Nombre']);
    $cliente->setApellidos($_POST['Apellidos']);
    $cliente->setCorreo($_POST['Correo']);
    $cliente->setContrasena($_POST['Contrasena']);
    
    $crud->actualizar($cliente);

}elseif($_GET['accion']=='s'){
    unset($_SESSION['usuario']);
    header('Location: ../index.php');
}/*elseif($_GET['accion']=='a'){
    
}*/
    
?>