<?php
class Compra{
        private $id_Producto;
        private $id_Vendedor;
        private $id_Usuario;
        private $total;
        private $Folio;
        
      
        function __construct(){}

        public function getid_Producto(){
            return $this->id_Producto;
        }
        public function setid_Producto($id_Producto){
            $this->id_Producto = $id_Producto;
        }
        public function getid_Vendedor(){
            return $this->id_Vendedor;
        }
        public function setid_Vendedor($id_Vendedor){
            $this->id_Vendedor = $id_Vendedor;
        }
        public function getid_Usuario(){
            return $this->id_Usuario;
        }
        public function setid_Usuario($id_Usuario){
            $this->id_Usuario = $id_Usuario;
        }
        public function settotal($total){
            $this->total = $total;
        }
        public function gettotal(){
            return $this->total;
        }
        public function getFolio(){
            return $this->Folio;
        }
        public function setFolio($Folio){
            $this->Folio = $Folio;
        }
    }
?>

