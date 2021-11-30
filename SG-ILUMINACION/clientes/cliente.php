<?php 
    class Cliente{
        private $id_Usuario;
        private $nombre;
        private $apellidos;
        private $correo;
        private $contrasena;

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

        public function getId(){
            return $this->id_Usuario;
        }
        public function setId($id_Usuario){
            $this->id_Usuario = $id_Usuario;
        }
    }
?>