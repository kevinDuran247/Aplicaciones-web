<?php 
if (!empty ($_POST["btnModificar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["fecha"]) and !empty($_POST["correo"])){
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha = $_POST["fecha"];
        $correo = $_POST["correo"];

        $UPDATE = "UPDATE persona SET nombre=?, apellido=?, fecha_nac=?, correo=? WHERE id=?";

        $stmt = $conn->prepare($UPDATE);
        $stmt ->bind_param("ssssi",$nombre,$apellido,$fecha,$correo,$id);
        $stmt ->execute();    
        $stmt ->close();
        $conn ->close();
        header("location:../crud.php");  
    }else {
        echo '<div class="alert alert-warning">Alguno de los campos esta vacio</div>';
    }
}
?>
