<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/crud_mongo/vendor/autoload.php";
class Conexion {
    public function conectar(){
        try{
            $server = "127.0.0.1";
            $user = "mongoadmin";
            $password = "123456";
            $dataBase = "crud";
            $puerto = "27017";

            $stringConn = "mongodb://".$user.":".$password."@".$server.":".$puerto."/".$dataBase;

            $cliente = new  MongoDB\Client($stringConn);
            return $cliente->selectDatabase($dataBase);
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }
}

?>