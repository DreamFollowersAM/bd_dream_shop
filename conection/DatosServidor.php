<?php
    class DatosServidor{
        private $sv = "localhost";
        private $us = "root";
        private $pa = "";
        private $bd = "bd_dream_shop";

        public function getS(){
            return $this->sv;
        }
        public function getUs(){
            return $this->us;
        }
        public function getPa(){
            return $this->pa;
        }
        public function getBD(){
            return $this->bd;
        }
    }

?>