<?php

    require_once ('conection/conection.php');
    
    class Usuarios{
        private $idusuario;
        private $correo;
        private $contrasena;
        private $idperfil;
        private $estado;

        function __construct()
        {
            $this->idusuario = 0;
            $this->correo = '';
            $this->contrasena = '';
            $this->idperfil = 0;
            $this->estado = 0;
        }

        public function setDatosIS($a,$b){
            $this->correo=$a;
            $this->contrasena=$b;   
        }
    
        public function iniciar_Sesion(){
            try{   
                $sql= "select * from usuario where correo='$this->correo' and contrasena='$this->contrasena' and estado=1";
                $resultado=$this->aplicarQry($sql);
                while($row=mysqli_fetch_assoc($resultado)){
                    $this->idusuario=$row['idusuario'];
                    $this->correo=$row['correo'];
                    $this->perfil=$row['idperfil'];
                }
                $_SESSION['correo']=$this->correo;
                $_SESSION['idusuario']=$this->idusuario;
                return $this->perfil;
            }catch(Exception $e){
                    echo "Error en el inicio de sesion".$e->getMessage();
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