<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:../index.php");
}

require_once "../clases/conexion.php";
require_once "../clases/crud.php";

$crud = new crud();
$id=$_GET["id"];
$datos = $crud->mostrarUnDato($id);
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
    <form class="col-4 p-3 m-auto" id="formulario" action="../procesos/modificar.php" method="POST">
        <h3 class="text-center">Modificar personas</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ID de la persona</label>
            <input type="text" class="form-control" value="<?php echo $datos->_id; ?>" disabled>
            <input type="hidden" name="id" value="<?php echo $datos->_id; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
            <input type="name" class="form-control" name="nombre" value="<?php echo $datos->nombre; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apellido de la persona</label>
            <input type="lastname" class="form-control" name="apellido" value="<?php echo $datos->apellido; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fecha" value="<?php echo $datos->nacimiento; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" name="correo" placeholder="example@gmail.com"
                value="<?php echo $datos->correo; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="btnModificar" value="ok">Registrar</button>
    </form>
</body>

</html>