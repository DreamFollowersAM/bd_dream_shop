<?php

    require_once ('conection/conection.php');
    
    class Productos{
        private $idarticulo;
        private $idcategoria;
        private $codigo;
        private $nombre;
        private $precio_venta;
        private $stock;
        private $descripcion;
        private $imagen;
        private $estado;

        function __construct()
        {
            $this->idarticulo = 0;
            $this->idcategoria = 0;
            $this->codigo = '';
            $this->nombre = '';
            $this->precio_venta = 0;
            $this->stock = 0;
            $this->descripcion = '';
            $this->imagen = '';
            $this->estado = 0;
        }

        public function lista(){
            try{
                $sql="select * from articulo";
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