<?php
    
    require_once ('usuarios/Modelos/Usuarios.php');
    require_once ('usuarios/Vista/Usuarios.php');

    class UsrCont{

        public $objUsrModelo;
        public $objUsrVista;
        
        function __construct()
        {
            $this->objUsrModelo = new Usuarios();
            $this->objUsrVista = new UsrVista();
        }

        public function iniciar_Sesion($a, $b){
            $this->objUsrModelo->setDatosIS($a,$b);
            $perfil=$this->objUsrModelo->iniciar_Sesion();
            if(isset($perfil) and $perfil!=null){
                switch($perfil){
                    case 1:
                        echo "soy admin";
                        $this->objUsrVista->admin();
                        break;
                    case 2:
                        echo "soy usuario final";
                        $this->objUsrVista->usrFnl();
                        break;
                    case 3:
                        echo "soy vendedor";
                        $this->objUsrVista->vndr();
                        break;
                    default:
                        header('location: index.php');
                        break;
                }
            }
        }

        public function inc(){
            $this->objUsrVista->inc();
        }
    }

?>