<?php
//incluye la DB
//require_once('conexion.php');
require_once('proveedor.php');

    class CrudProveedor{
        public function __construct(){}

        //método para insertar, recibe como parámetro un objeto de tipo proveedor
        public function insertar($proveedor){
            $conn=Db::conectar();
            $insert=$conn->prepare('INSERT INTO proveedor VALUES(NULL,:Nombre,:Apellidos,:Correo,:Contrasena,:Marca)');
            $insert->bindValue('Nombre',$proveedor->getNombre());
            $insert->bindValue('Apellidos',$proveedor->getApellidos());
            $insert->bindValue('Correo',$proveedor->getCorreo());
            $insert->bindValue('Contrasena',$proveedor->getContrasena());
            $insert->bindValue('Marca',$proveedor->getMarca());
            $insert->execute();
        }

        //metodo para mostrar todos los proveedores
        public function mostrar(){
            $conn=Db::conectar();
            $listaProveedores=[];
            $select=$conn->query('SELECT * FROM proveedor');

            foreach($select->fetchAll() as $proveedor){
                $myProveedor= new Proveedor();
                $myProveedor->setId($proveedor['id_Proveedor']);
                $myProveedor->setNombre($proveedor['Nombre']);
                $myProveedor->setApellidos($proveedor['Apellidos']);
                $myProveedor->setCorreo($proveedor['Correo']);
                $myProveedor->setContrasena($proveedor['Contrasena']);
                $myProveedor->setMarca($proveedor['Marca']);
                $listaProveedores[]=$myProveedor;
            }
            return $listaProveedores;
        }

        //metodo para eliminar proveedores, recibe como parametro el id del proveedor
        public function eliminar($id){
            $conn=Db::conectar();
            $eliminar = $conn->prepare('DELETE FROM proveedor WHERE id_Proveedor=:id_Proveedor');
            $eliminar->bindValue('id_Proveedor', $id);
            $eliminar->execute();
        }

        //metodo para buscar un proveedor, recibe como parametro id del proveedor
        public function obtenerProveedor($id){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM proveedor WHERE id_Proveedor=:id_Proveedor');
            $select->bindValue('id_Proveedor', $id);
            $select->execute();
            $proveedor=$select->fetch();
            $myProveedor= new Proveedor();
            $myProveedor->setId($proveedor['id_Proveedor']);
            $myProveedor->setNombre($proveedor['Nombre']);
            $myProveedor->setApellidos($proveedor['Apellidos']);
            $myProveedor->setCorreo($proveedor['Correo']);
            //$myProveedor->setContrasena($proveedor['Contrasena']);
            $myProveedor->setMarca($proveedor['Marca']);

            return $myProveedor;
        }

        //metodo para buscar un proveedor para el login
        public function loginProveedor($correo, $clave){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM proveedor WHERE Correo=:Correo');
            $select->bindValue('Correo', $correo);
            $select->execute();
            $proveedor=$select->fetch();
            $myProveedor= new Proveedor();
            //Verifica si la clave es correcta
            if(strcmp($clave, $proveedor['Contrasena'])==0){
                $myProveedor->setId($proveedor['id_Proveedor']);
                $myProveedor->setNombre($proveedor['Nombre']);
                $myProveedor->setApellidos($proveedor['Apellidos']);
                $myProveedor->setCorreo($proveedor['Correo']);
                $myProveedor->setContrasena($proveedor['Contrasena']);
                $myProveedor->setMarca($proveedor['Marca']);
            }

            return $myProveedor;
        }

    }

?>