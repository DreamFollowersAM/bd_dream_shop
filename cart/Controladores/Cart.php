<?php

    require_once ('cart/Modelos/Cart.php');    
    require_once ('cart/Vista/Cart.php');    

    class CartCont{
        private $objCartModel;
        private $objCartView;
        private $acum;
        private $total;

        function __construct()
        {
            $this->objCartModel = new CartModel();
            $this->objCartView = new CartView();
            $this->acum = 0;
            $this->total = 0;
        }

        public function add($id){
            if(isset($_SESSION['carrito'][$id])){
                $_SESSION['carrito'][$id]++;
            }else{
                $_SESSION['carrito'][$id]=1;
            }
            return $this->createCart();
        }

        public function reducir($id){
            if(isset($_SESSION['carrito'][$id]) && $_SESSION['carrito'][$id] > 1 ){
                $_SESSION['carrito'][$id]--;
            }else{
                unset($_SESSION['carrito'][$id]);
                if($_SESSION['carrito']==null){
                    $_SESSION['acum']=0;
                    $_SESSION['total']=0;
                }
            }
            return $this->createCart();
        }

        public function vaciar(){
            unset($_SESSION['carrito']);
            session_destroy();
            $_SESSION['acum']=0;
            $_SESSION['total']=0;
        }
        public function createCart(){
            if(isset($_SESSION['carrito'])){
                $datos=array();
                foreach($_SESSION['carrito'] as $id=>$x){
                    $datosProd=$this->objCartModel->get($id);
                    while($renglon=mysqli_fetch_assoc($datosProd)){
                        $id=$renglon['idarticulo'];
                        $imagen=$renglon['imagen'];
                        $nombre=$renglon['nombre'];
                        $descripcion=$renglon['descripcion'];
                        $precio=$renglon['precio_venta'];
                        $importe=$precio*$x;

                        //permiten sacar los datos globales del carrito como el importe total y la cantidad del producto
                        $this->acum=$this->acum+$x;
                        $this->total=$this->total+$importe;
                     
                        //preparar el arreglo para la vista
                        $Dict=array(
                            '{ID}'=>$id,
                            '{IMAGEN}'=>$imagen,
                            '{NOMBRE}'=>$nombre,
                            '{DESCRIPCION}'=>$descripcion,
                            '{PRECIO}'=>$precio,
                            '{CANTIDAD}'=>$x,
                            '{IMPORTE}'=>$importe);

                            array_push($datos, $Dict);
                            $_SESSION['acum']=$this->acum;
                            $_SESSION['total']=$this->total;
                        
                    }
                }
                return $datos;
            }
        }
    }

?>