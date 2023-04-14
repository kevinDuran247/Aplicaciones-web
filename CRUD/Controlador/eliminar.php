<?php
    if (!empty ($_GET["id"])) {
        $id = $_GET["id"];
        
        $DELETE = "DELETE FROM persona WHERE id=?";
        
        $stmt = $conn->prepare($DELETE);
        $stmt ->bind_param("i",$id);
        $stmt ->execute();   
        echo '<div class="alert alert-success">Persona eliminada correctamente</div>';
        $stmt ->close();
        $conn ->close(); 
    }
?>