<?php

    class CartView{

        public function carrito($products){
            $pagina = file_get_contents("public_html/cart.html");

            if(isset ($_SESSION['total']) && isset ($_SESSION['acum'])){
                $pagina = str_replace("{TOTAL}","$".$_SESSION['total'],$pagina);
                $pagina = str_replace("{ACUM}",$_SESSION['acum'],$pagina);
            }else{
                $pagina = str_replace("{TOTAL}","$0",$pagina);
                $pagina = str_replace("{ACUM}","0",$pagina);
            }

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