<?php

    require_once ('ticket/Modelos/Ticket.php');    
    require_once ('ticket/Vista/Ticket.php');    
    require_once ('cart/Modelos/Cart.php');  

    class TicketCont{

        private $objTicketModel;
        private $objTicketView;
        private $objCartModel;
        private $ivat;
        private $preciot;

        function __construct()
        {
            $this->objTicketModel = new TicketModel();
            $this->objTickettView = new TicketView();
            $this->objCartModel = new CartModel();
            $this->ivat = 0;
            $this->preciot = 0;
        }
        
        public function createTicket(){
            if(isset($_SESSION['carrito'])){
                $datos=array();
                foreach($_SESSION['carrito'] as $id=>$x){
                    $datosProd=$this->objCartModel->get($id);
                    while($renglon=mysqli_fetch_assoc($datosProd)){
                        $id=$renglon['idarticulo'];
                        $imagen=$renglon['imagen'];
                        $nombre=$renglon['nombre'];
                        $descripcion=$renglon['descripcion'];
                        $precio=($renglon['precio_venta'])-($renglon['precio_venta']*.16);
                        $iva=$renglon['precio_venta']*.16;
                        $importe=$precio*$x;

                        $this->ivat+=$iva;
                        $this->preciot+=$precio;
                     
                        $Dict=array(
                            '{ID}'=>$id,
                            '{IMAGEN}'=>$imagen,
                            '{NOMBRE}'=>$nombre,
                            '{DESCRIPCION}'=>$descripcion,
                            '{PRECIO}'=>$precio,
                            '{IVA}'=>$iva,
                            '{CANTIDAD}'=>$x,
                            '{IMPORTE}'=>$importe);

                            array_push($datos, $Dict);
                    }
                }
                $_SESSION['ivat']=$this->ivat;
                $_SESSION['preciot']=$this->preciot;
                    
                $this->ivat=0;
                $this->preciot=0;
                return $datos;
            }
        }

    }

?>