<?php

    require_once ('conection/conection.php');

    class CartModel{

        private $id;

        function __construct()
        {
            $this->id = 0;
        }

        public function get($id){
            $this->id = $id;
            try{
                $sql="select * from articulo where idarticulo = '$this->id'";
                $resultado=$this->aplicarQry($sql);
                return $resultado;
            }catch(Exception $e){
                echo "error en la consulta ".$e->getMessage();
            }
        }

        public function aplicarQry($sql){
            $objConectar = new conection();
            $resultado = $objConectar->ejecutarConsulta($sql);
            $objConectar->cerrar();
            return $resultado;
        }

    }

?>