<?php

//incluye la DB
//require_once('conexion.php');
    class CrudCarrito{
        public function __construct(){}

        //método para insertar, recibe como parámetro un objeto de tipo producto
        public function insertar($Carrito){
            $conn=Db::conectar();
            $insert=$conn->prepare('INSERT INTO carrito_compra VALUES(:id_Cliente,:id_Producto,:cantidad)');
            $insert->bindValue('id_Cliente',$Carrito->getId_user());
            $insert->bindValue('id_Producto',$Carrito->getId_producto());
            $insert->bindValue('cantidad',$Carrito->get_cantidad());
            $insert->execute();
        }

        //metodo para mostrar todos los productoes
        public function mostrar_carrito($id_user){
            $conn=Db::conectar();
            $listaProductos=[];
            $select=$conn->prepare('SELECT * FROM carrito_compra WHERE id_Cliente=:id_Cliente');
            $select->bindValue('id_Cliente', $id_user);
            $select->execute();
            foreach($select->fetchAll() as $Carrito){
                $myCarrito= new Carrito();
                $myCarrito->setId_producto($Carrito['id_Producto']);
                $myCarrito->setId_user($Carrito['id_Cliente']);
                $myCarrito->set_cantidad($Carrito['cantidad']);
                $listaProductos[]=$myCarrito;
            }
            return $listaProductos;
        }

        //metodo para eliminar productos, recibe como parametro el id del producto
        public function eliminar($id_prod, $id_cliente){
            $conn=Db::conectar();
            $eliminar = $conn->prepare('DELETE FROM carrito_compra WHERE id_Producto=:id_Producto AND id_Cliente=:id_Cliente');
            $eliminar->bindValue('id_Producto', $id_prod);
            $eliminar->bindValue('id_Cliente', $id_cliente);
            $eliminar->execute();
        }

        //metodo para buscar un producto, recibe como parametro id del producto
        public function obtenerProductos($id_Producto){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM carrito_compra WHERE id_Producto=:id_Producto');
            $select->bindValue('id_Producto', $id_Producto);
            $select->execute();
            $Carrito=$select->fetch();
            $myCarrito= new Carrito();
            $myCarrito->setId_producto($Carrito['id_Producto']);
            $myCarrito->setId_user($Carrito['id_Cliente']);
            return $myCarrito;
        }
        public function vaciarCarrito($id_cliente){
            $conn=Db::conectar();
            $eliminar = $conn->prepare('DELETE FROM carrito_compra WHERE id_Cliente=:id_Cliente');
            $eliminar->bindValue('id_Cliente', $id_cliente);
            $eliminar->execute();
        }

        //metodo para actualizar un producto, recibe como parametro el producto
        public function actualizar($Carrito){
            $conn=Db::conectar();
            $actualizar=$conn->prepare('UPDATE carrito_compra SET id_Producto=:id_Producto, id_Cliente=:id_Cliente, cantidad=:cantidad WHERE id_Producto=:id_Producto AND id_Cliente=:id_Cliente');
            $actualizar->bindValue('id_Producto',$Carrito->getId_producto());
            $actualizar->bindValue('id_Cliente',$Carrito->getId_user());
            $actualizar->bindValue('cantidad',$Carrito->get_cantidad());
            $actualizar->execute();
        }
    }
