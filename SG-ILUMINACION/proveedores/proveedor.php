<?php 
    class Proveedor{
        private $id_Proveedor;
        private $nombre;
        private $apellidos;
        private $correo;
        private $contrasena;
        private $marca;

        function __construct(){}

        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
       }

        public function getApellidos(){
            return $this->apellidos;
        }
        public function setApellidos($apellidos){
            $this->apellidos = $apellidos;
        }

        public function getCorreo(){
            return $this->correo;
        }
        public function setCorreo($correo){
            $this->correo = $correo;
        }

        public function getContrasena(){
            return $this->contrasena;
        }
        public function setContrasena($contra){
            $this->contrasena = $contra;
        }

        public function getMarca(){
            return $this->marca;
        }
        public function setMarca($marca){
            $this->marca = $marca;
        }

        public function getId(){
            return $this->id_Proveedor;
        }
        public function setId($id_Proveedor){
            $this->id_Proveedor = $id_Proveedor;
        }
    }
    

?>