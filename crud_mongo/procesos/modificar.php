<?php
include "../clases/conexion.php";
include "../clases/crud.php";

$crud = new crud();

$id = $_POST["id"];
$datos = array(
    "nombre" => filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING),
    "apellido" => filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING),
    "nacimiento" => filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING),
    "correo" => filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL)
);

$respuesta = $crud->modificarDatos($id,$datos);

if ($respuesta->getModifiedCount() > 0 || $respuesta->getmatchedCount() > 0){
    header("location: ../crud.php");
}else{
    echo '<div class="alert alert-warning">Algo fallo!</div>';
}
?>