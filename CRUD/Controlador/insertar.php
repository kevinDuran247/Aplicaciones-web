<?php 
if (!empty ($_POST["btnregistrar"])) {
    
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["fecha"]) and !empty($_POST["correo"])){
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha = $_POST["fecha"];
        $correo = $_POST["correo"];

        $INSERT = "INSERT INTO persona (nombre,apellido,fecha_nac,correo) VALUES(?,?,?,?)";

        $stmt = $conn->prepare($INSERT);
        $stmt ->bind_param("ssss",$nombre,$apellido,$fecha,$correo);
        $stmt ->execute();
        echo '<div class="alert alert-success">Persona registrada correctamente</div>';
        
        $stmt ->close();
        $conn ->close();
    }else {
        echo '<div class="alert alert-warning">Alguno de los campos esta vacio</div>';
    }
}
?>
