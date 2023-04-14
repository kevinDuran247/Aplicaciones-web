<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:index.php");
}

require_once "./clases/conexion.php";
require_once "./clases/crud.php";

//Muestra todos los registros en la tabla
$crud = new crud();
$datos = $crud->mostrarDatos();

//Elimna registro de la base de datos
if (!empty ($_GET["id"])) {
    $id = $_GET["id"];
    $respuesta = $crud->eliminar($id); 
    header("location: crud.php");                      
}                                
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
    @media screen and (max-width: 800px) {
        #formulario {
            width: 100%;
            display: grid;
            justify-content: center;
            align-content: center;
        }

        #tabla {
            width: 100%;
            display: grid;
            justify-content: center;
            align-content: center;
        }

        #tdd {
            max-width: 80px;
            overflow: auto;
        }
    }
    </style>
    <script>
    function eliminar() {
        var r = confirm("¿Estas seguro que deseas eliminar?");
        return r;
    }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <div class=" d-flex gap-2 mb-3 p-1 d-md-flex ">
        <a class="btn btn-danger" href="Controlador/cerrarLogin.php">Cerrar sesión</a>
        <div class="p-2">
            <?php
                echo $_SESSION["user"];
            ?>
        </div>
    </div>
    <div class="container-fluid row">
        <form class="col-4 p-3" id="formulario" action="./procesos/insertar.php" method="POST">
            <h3 class="text-center">Registro de personas</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                <input type="name" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellido de la persona</label>
                <input type="lastname" class="form-control" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" name="correo" placeholder="example@gmail.com" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>
        <div class="col-8 p-4" id="tabla">
            <table class="table table-dark table-striped">
                <form action="Controlador/buscador.php" method="POST">
                    <div class="mb-1">
                        <input type="text" class="form-control" name="nombreConsulta"
                            placeholder="Con escribir un par de letras basta">
                    </div>
                    <div class="mb-4 d-md-flex justify-content-md-end">
                        <input type="submit" value="Buscar por nombre" class="btn btn-primary" name="btnConsulta" />
                    </div>
                </form>
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Nacimiento</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($datos as $item) { 
                    ?>
                    <tr>
                        <td><?php echo $item->nombre; ?></td>
                        <td><?php echo $item->apellido; ?></td>
                        <td><?php echo $item->nacimiento; ?></td>
                        <td id="tdd"><?php echo $item->correo; ?></td>
                        <td>
                            <a href="Controlador/modificarForm.php?id=<?php echo $item->_id; ?>"
                                class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="return eliminar()" href="crud.php?id=<?php echo $item->_id; ?>"
                                class="btn btn-small btn-danger" name="btnEliminar"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src=https://kit.fontawesome.com/646ac4fad6.js crossorigin="anonymous"></script>
</body>

</html>