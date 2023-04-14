<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:../index.php");
}

include "conexion.php";
$id=$_GET["id"];
$sql = $conn->query("SELECT id, nombre, apellido, fecha_nac, correo FROM persona WHERE id = $id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
<form class="col-4 p-3 m-auto" id="formulario" method="POST"> 
        <?php
            include "conexion.php";
            include "modificar.php";
        ?>            
        <h3 class="text-center">Modificar personas</h3>
        <?php
            while($datos = $sql->fetch_object()){ ?> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID de la persona</label>
                <input type="text" class="form-control" value="<?= $datos->id ?>" disabled>
                <input type="hidden" name="id" value="<?= $datos->id ?>"> 
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                <input type="name" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellido de la persona</label>
                <input type="lastname" class="form-control" name="apellido" value="<?= $datos->apellido ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha" value="<?= $datos->fecha_nac ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" name="correo" placeholder="example@gmail.com" value="<?= $datos->correo ?>">
            </div>
            <?php }
            ?>
            <button type="submit" class="btn btn-primary" name="btnModificar" value="ok">Registrar</button>           
        </form>
</body>
</html>