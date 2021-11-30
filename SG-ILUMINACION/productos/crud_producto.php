<?php
//incluye la DB
//require_once('conexion.php');
    class CrudProducto{
        public function __construct(){}

        //metodo para mostrar todos los productoes
        public function mostrar(){
            $conn=Db::conectar();
            $listaProductos=[];
            $select=$conn->query('SELECT * FROM producto');

            foreach($select->fetchAll() as $producto){
                $myProducto= new Producto();
                $myProducto->setId($producto['id_Producto']);
                $myProducto->setIdF($producto['fila_id']);
                $myProducto->setIdV($producto['id_Vendedor']);
                $myProducto->setNombre($producto['Nombre']);
                $myProducto->setPrecio($producto['Precio']);
                $myProducto->setTipo($producto['Tipo']);
                $myProducto->setURL($producto['Imagen_url']);
                $myProducto->setCaracteristicas($producto['Caracteristicas']);
                $myProducto->setDescuento($producto['Descuento']);
                $myProducto->setStock($producto['Stock']);
                $listaProductos[]=$myProducto;
            }
            return $listaProductos;
        }

        //metodo para eliminar productos, recibe como parametro el id del producto
        public function eliminar($id){
            $conn=Db::conectar();
            $eliminar = $conn->prepare('DELETE FROM producto WHERE id_Producto=:id_Producto');
            $eliminar->bindValue('id_Producto', $id);
            $eliminar->execute();
        }

        //metodo para buscar un producto, recibe como parametro id del producto
        public function obtenerProducto($id){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM producto WHERE id_Producto=:id_Producto');
            $select->bindValue('id_Producto', $id);
            $select->execute();
            $producto=$select->fetch();
            $myProducto= new Producto();
            $myProducto->setId($producto['id_Producto']);
            $myProducto->setIdF($producto['fila_id']);
            $myProducto->setIdV($producto['id_Vendedor']);
            $myProducto->setNombre($producto['Nombre']);
            $myProducto->setPrecio($producto['Precio']);
            $myProducto->setTipo($producto['Tipo']);
            $myProducto->setURL($producto['Imagen_url']);
            $myProducto->setCaracteristicas($producto['Caracteristicas']);
            $myProducto->setDescuento($producto['Descuento']);
            $myProducto->setStock($producto['Stock']);

            return $myProducto;
        }

        /*public function actualizarStock($id_prod, $cantidad){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT Stock FROM producto WHERE id_Producto=:id_Producto');
            $select->bindValue('id_Producto', $id_prod);
            $select->execute();
            $stock=$select->fetch(); 
            $stock = $producto-$cantidad;

            $update=$conn->prepare('UPDATE producto SET Stock=:Stock WHERE id_Producto=:id_Producto');
            $update->bindValue('Stock',$stock);
            $update->
        }*/
    }

?>