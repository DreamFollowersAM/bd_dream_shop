<?php

    class TicketView{

        public function ticket($products){
            $pagina = file_get_contents("public_html/ticket.html");

            if(isset ($_SESSION['total']) && isset ($_SESSION['acum']) && isset ($_SESSION['ivat']) && isset ($_SESSION['preciot'])){
                $pagina = str_replace("{TOTAL}","$".$_SESSION['total'],$pagina);
                $pagina = str_replace("{ACUM}",$_SESSION['acum'],$pagina);
                $pagina = str_replace("{IVAT}","$".$_SESSION['ivat'],$pagina);
                $pagina = str_replace("{PRECIOT}",$_SESSION['preciot'],$pagina);
            }else{
                $pagina = str_replace("{TOTAL}","$0",$pagina);
                $pagina = str_replace("{ACUM}","0",$pagina);
                $pagina = str_replace("{IVAT}","$0",$pagina);
                $pagina = str_replace("{PRECIOT}","$0",$pagina);
            }

            $pagina = str_replace("{FECHA}",date("D, d M Y H:i:s"),$pagina);

            $pos1 = strpos($pagina, '<!-- Gallery -->');
            $pos2 = strrpos($pagina, '<!-- Gallery -->');
            $length = $pos2 - $pos1;
            $match = substr($pagina, $pos1, $length);
            $render = "";
            foreach($products as $i => $dict){
                $render.=str_replace(array_keys($dict),array_values($dict),$match);
            }
            $pagina = str_replace($match, $render, $pagina);
            print($pagina);
        }
    }

?>