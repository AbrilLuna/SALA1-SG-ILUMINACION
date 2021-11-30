<?php

class Carrito{
        private $id_Usuario;
        private $id_producto;
        private $cant;
        function __construct(){}

        public function get_cantidad(){
            return $this->cant;
        }
        public function set_cantidad($cantidad){
            $this->cant = $cantidad;
        }

        public function getId_user(){
            return $this->id_Usuario;
        }
        public function setId_user($id_User){
            $this->id_Usuario = $id_User;
        }  
              
        public function getId_producto(){
            return $this->id_producto;
        }
        public function setId_producto($id_prod){
            $this->id_producto = $id_prod;
        }

    }