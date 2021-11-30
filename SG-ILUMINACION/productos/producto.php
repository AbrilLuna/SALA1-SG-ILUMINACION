<?php 
    class Producto{
        private $id_Producto;
        private $fila_id;
        private $id_Vendedor;
        private $nombre;
        private $precio;
        private $tipo;
        private $url;
        private $caracteristicas;
        private $descuento;
        private $stock;

        function __construct(){}

        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
       }

        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function getTipo(){
            return $this->tipo;
        }
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }

        public function getURL(){
            return $this->url;
        }
        public function setURL($url){
            $this->url = $url;
        }

        public function getCaracteristicas(){
        return $this->caracteristicas;
        }
        public function setCaracteristicas($c){
            $this->caracteristicas = $c;
        }

        public function getDescuento(){
            return $this->descuento;
        }
        public function setDescuento($d){
            $this->descuento = $d;
        }

        public function getStock(){
            return $this->stock;
        }
        public function setStock($stock){
            $this->stock = $stock;
        }

        public function getIdF(){
            return $this->fila_id;
        }
        public function setIdF($idF){
            $this->fila_id = $idF;
        }
        
        public function getIdV(){
            return $this->id_Vendedor;
        }
        public function setIdV($idV){
            $this->id_Vendedor = $idV;
        }

        public function getId(){
            return $this->id_Producto;
        }
        public function setId($id){
            $this->id_Producto = $id;
        }
    }
    

?>