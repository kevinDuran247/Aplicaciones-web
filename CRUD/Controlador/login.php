<?php
session_start();
if(!empty($_POST["entrar"])){
    if (!empty($_POST["user"]) and !empty($_POST["password"])) {
        $user=$_POST["user"];
        $password=$_POST["password"];

        $SELECT = "SELECT id, usuario FROM user WHERE usuario=? and contraseña=?";

        $stmt = $conn->prepare($SELECT);
        $stmt ->bind_param("ss",$user,$password);
        $stmt ->execute();
        $stmt->store_result();
        
        if($stmt->num_rows() > 0) {
            $stmt->bind_result($id, $usuario);
            while($stmt->fetch()){
                $_SESSION["id"] = $id;
                $_SESSION["user"] = $usuario;
            }
            header("location:crud.php");
        } else {
            echo "<font color='white'><b><i>Usuario no existe!<i><b></font>";
        }
        $stmt ->close();
        $conn ->close();       
    } else {
        echo "<font color='white'><b>CAMPOS VACIOS!<b></font>";
    }
    
}

?>