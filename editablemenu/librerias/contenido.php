<?php
class contenido{

    public function ver(){

        if(!(isset($_GET["url"]))){
            return "vistas/menu_lateral.php";
        }
        
        $datos=explode("/",$_GET["url"]);

    }
}
?>