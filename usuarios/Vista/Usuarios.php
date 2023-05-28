<?php
    
    class UsrVista{

        public function admin(){
            $pagina = file_get_contents("public_html/admin.html");
            $pagina = str_replace("{USR}",$_SESSION['correo'],$pagina);
            print($pagina);
        }

        public function usrFnl(){
            $pagina = file_get_contents("public_html/usrFnl.html");
            $pagina = str_replace("{USRUF}","",$pagina);
            print($pagina);
        }

        public function vndr(){
            $pagina = file_get_contents("public_html/vndr.html");
            $pagina = str_replace("{USRVN}","",$pagina);
            print($pagina);
        }

        public function inc(){
            $pagina = file_get_contents("public_html/login.html");
            print($pagina);
        }

    }

?>