<?php
    require_once('DatosServidor.php');

    class conection{
        private $conectar;

        function __construct(){
            $objServidor = new DatosServidor();
            try{
                $this->conectar = new mysqli($objServidor->getS(), $objServidor->getUs(), $objServidor->getPa(), $objServidor->getBD());
                if($this->conectar->connect_errno){
                    echo "error en la conexion ".$this->conectar->connect_errno;
                }
            }catch(Exception $e){
                echo "no se logro la conexion ".$e->getMessage();
            }
        }

        public function ejecutarConsulta($sql){
            try{
                $registro=$this->conectar->query($sql);
                return $registro;
            }catch(Exception $e){
                echo "error en la consulta ".$e->getMessage();
            }
        }

        public function cerrar(){
            mysqli_close($this->conectar);
        }
    }

?>