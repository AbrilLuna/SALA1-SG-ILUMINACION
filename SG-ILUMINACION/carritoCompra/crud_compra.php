<?php

//require_once('conexion.php');
    class CrudCompra{
        public function __construct(){}

        //método para insertar, recibe como parámetro un objeto de tipo producto
        public function insertar($Compra){
            $conn=Db::conectar();
            $insert=$conn->prepare('INSERT INTO compra VALUES( :id_Proveedor,:id_Usuario,:id_Producto,:Total,:Folio)');
            $insert->bindValue('id_Proveedor',$Compra->getid_Vendedor());
            $insert->bindValue('id_Usuario',$Compra->getid_Usuario());
            $insert->bindValue('id_Producto',$Compra->getid_Producto());
            $insert->bindValue('Total',$Compra->gettotal());
            $insert->bindValue('Folio',$Compra->getFolio());
            $insert->execute();
        }

        //metodo para mostrar todos los productoes
        public function mostrar(){
            $conn=Db::conectar();
            $listaCompras=[];
            $select=$conn->query('SELECT * FROM compra');

            foreach($select->fetchAll() as $Compra){
                $myProducto= new Producto();
                $myProducto->setId_Vendedor($Compra['id_Proveedor']);
                $myProducto->setid_Usuario($Compra['id_Usuario']);
                $myProducto->setid_Producto($Compra['id_Producto']);
                $myProducto->settotal($Compra['Total']);
                $myProducto->setFolio($Compra['Folio']);
                
                $listaCompras[]=$myProducto;
            }
            return $listaCompras;
        }

        //metodo para eliminar productos, recibe como parametro el id del producto
        public function eliminar($id_User){
            $conn=Db::conectar();
            $eliminar = $conn->prepare('DELETE FROM compra WHERE id_Usuario=:id_Usuario');
            $eliminar->bindValue('id_Usuario', $id_User);
            $eliminar->execute();
        }

        //metodo para buscar un producto, recibe como parametro id del producto
        public function obtenerCompra($Fol){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM compra WHERE Folio=:Folio');
            $select->bindValue('Folio', $Fol);
            $select->execute();
            $producto=$select->fetch();
            $myProducto= new Compra();
            $myProducto->setid_Producto($producto['id_Producto']);
            $myProducto->setid_Vendedor($producto['id_Proveedor']);
            $myProducto->setid_Usuario($producto['id_Usuario']);
            $myProducto->settotal($producto['Total']);
            $myProducto->setFolio($producto['Folio']);
            return $myProducto;
        }
        public function actualizar($Compra){
            $conn=Db::conectar();
            $actualizar=$conn->prepare('UPDATE compra SET id_Producto=:id_Producto, id_Usuario=:id_Usuario, id_Proveedor=:id_Proveedor, Total=:Total WHERE Folio=:Folio');
            $actualizar->bindValue('id_Producto',$Compra->getId_producto());
            $actualizar->bindValue('id_Usuario',$Compra->getid_Usuario());
            $actualizar->bindValue('id_Proveedor',$Compra->getid_Vendedor());
            $actualizar->bindValue('Total',$Compra->gettotal());
            $actualizar->bindValue('Folio',$Compra->getFolio());
            $actualizar->execute();
        }
    }

?>

