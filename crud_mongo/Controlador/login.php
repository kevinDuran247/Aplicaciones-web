<?php
session_start();
require_once "./clases/conexion.php";
$bd = new conexion();

if(!empty($_POST["entrar"])){
    if (!empty($_POST["user"]) and !empty($_POST["password"])) {
        $user=$_POST["user"];
        $password=$_POST["password"];

            $conn = $bd->conectar();
            $coleccion = $conn->user;
            $respuesta = $coleccion->findOne(array('user' => $user, 'password' => $password));          
        
        if($respuesta) {
                $_SESSION["id"] = $respuesta->_id;
                $_SESSION["user"] = $respuesta->user;
            header("location:crud.php");
        } else {
            echo "<font color='white'><b><i>Usuario no existe!<i><b></font>";
        }  
    } else {
        echo "<font color='white'><b>CAMPOS VACIOS!<b></font>";
    }   
}
?>