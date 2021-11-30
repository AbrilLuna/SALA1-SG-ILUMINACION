<?php
//incluye la DB
require_once('conexion.php');
    class CrudCliente{

        public function __construct(){}

        //método para insertar, recibe como parámetro un objeto de tipo clientes
        public function insertar($cliente){      
            $conn=Db::conectar();
            $insert=$conn->prepare('INSERT INTO usuario values(NULL,:Nombre,:Apellidos,:Correo,:Contrasena)');
            $insert->bindValue('Nombre',$cliente->getNombre());
            $insert->bindValue('Apellidos',$cliente->getApellidos());
            $insert->bindValue('Correo',$cliente->getCorreo());
            $insert->bindValue('Contrasena',$cliente->getContrasena());
            //encripta la clave
            /*$pass=password_hash($cliente->getContrasena(),PASSWORD_DEFAULT);
			$insert->bindValue('Contrasena',$pass);*/
            $insert->execute();
        }

        //metodo para mostrar todos los clientes
        public function mostrar(){
            $conn=Db::conectar();
            $listaClientes=[];
            $select=$conn->query('SELECT * FROM usuario');

            foreach($select->fetchAll() as $cliente){
                $myCliente= new Cliente();
                $myCliente->setId($cliente['id_Usuario']);
                $myCliente->setNombre($cliente['Nombre']);
                $myCliente->setApellidos($cliente['Apellidos']);
                $myCliente->setCorreo($cliente['Correo']);
                $myCliente->setContrasena($cliente['Contrasena']);
                $listaClientes[]=$myCliente;
            }
            return $listaClientes;
        }

        //metodo para eliminar clientes, recibe como parametro el id del cliente
        public function eliminar($id){
            $conn=Db::conectar();
            $eliminar = $conn->prepare('DELETE FROM usuario WHERE id_Usuario=:id_Usuario');
            $eliminar->bindValue('id_Usuario', $id);
            $eliminar->execute();
        }

        //metodo para buscar un cliente, recibe como parametro id del cliente
        public function obtenerCliente($id){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM usuario WHERE id_Usuario=:id_Usuario');
            $select->bindValue('id_Usuario', $id);
            $select->execute();
            $cliente=$select->fetch();
            $myCliente= new Cliente();
            $myCliente->setId($cliente['id_Usuario']);
            $myCliente->setNombre($cliente['Nombre']);
            $myCliente->setApellidos($cliente['Apellidos']);
            $myCliente->setCorreo($cliente['Correo']);
            $myCliente->setContrasena($cliente['Contrasena']);

            return $myCliente;
        }

        //Metodo para obtener el usuario para el login 
        
        public function obtenerUsuario($correo, $clave){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM usuario WHERE Correo=:Correo');
            $select->bindValue('Correo',$correo);
            $select->execute();
            $cliente=$select->fetch();
            $myCliente= new Cliente();
            //Verifica si la clave es correcta
            if(strcmp($clave, $cliente['Contrasena'])==0){
                //si es correcta, asigna los valores que trae desde la base de datos
                $myCliente->setId($cliente['id_Usuario']);
                $myCliente->setNombre($cliente['Nombre']);
                $myCliente->setApellidos($cliente['Apellidos']);
                $myCliente->setCorreo($cliente['Correo']);
                $myCliente->setContrasena($cliente['Contrasena']);
            }
            return $myCliente;
        }
        //Pasword encriptado pero no funciona XD
        /*public function obtenerUsuario($correo, $clave){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM usuario WHERE Correo=:Correo');
            $select->bindValue('Correo',$correo);
            $select->execute();
            $cliente=$select->fetch();
            $myCliente= new Cliente();
            //Verifica si la clave es correcta
            if(password_verify($clave, $cliente['Contrasena'])){
                //si es correcta, asigna los valores que trae desde la base de datos
                $myCliente->setId($cliente['id_Usuario']);
                $myCliente->setNombre($cliente['Nombre']);
                $myCliente->setApellidos($cliente['Apellidos']);
                $myCliente->setCorreo($cliente['Correo']);
                $myCliente->setContrasena($cliente['Contrasena']);
            }
            return $myCliente;
        }*/

        //metodo para actualizar un cliente, recibe como parametro el cliente
        public function actualizar($cliente){
            $conn=Db::conectar();
            $actualizar=$conn->prepare('UPDATE usuario SET Nombre=:Nombre, Apellidos=:Apellidos, Correo=:Correo, Contrasena=:Contrasena WHERE id_Usuario=:id_Usuario');
            $actualizar->bindValue('id_Usuario',$cliente->getId());
            $actualizar->bindValue('Nombre',$cliente->getNombre());
            $actualizar->bindValue('Apellidos',$cliente->getApellidos());
            $actualizar->bindValue('Correo',$cliente->getCorreo());
            $actualizar->bindValue('Contrasena',$cliente->getContrasena());

            $actualizar->execute();
        }
    }

?>