<?php
    
    require_once ('products/Modelos/Productos.php');
    require_once ('products/Vista/Productos.php');

    class ProdCont{

        public $objProducto;
        public $objVista;

        function __construct()
        {
            $this->objProducto = new Productos();
            $this->objVista = new Vista();
        }

        public function lista(){
            $registros=$this->objProducto->lista();
            $dato=array();
            while($renglon=mysqli_fetch_assoc($registros)){
                $dict=array(
                    '{ID}'=>$renglon['idarticulo'],
                    '{FOTO}'=>$renglon['imagen'],
                    '{NOMBRE}'=>$renglon['nombre'],
                    '{DESCRIPCION}'=>$renglon['descripcion'],
                    '{PRECIO}'=>$renglon['precio_venta'],
                    '{STOCK}'=>$renglon['stock']
                );
                array_push($dato, $dict);
            }
            $this->objVista->gallery($dato);
        }

    }

?>