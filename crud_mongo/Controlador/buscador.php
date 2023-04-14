<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:../index.php");
}

require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$busqueda = $_POST["nombreConsulta"];
$resultados = $crud->consultar($busqueda);

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
        <a class="btn btn-danger" href="cerrarLogin.php">Cerrar sesión</a>
        <div class="p-2">
            <?php
                echo $_SESSION["user"];
            ?>
        </div>
    </div>
    <div class="p-5" id="tabla">
        <table class="table table-dark table-striped">
            <form action="buscador.php" method="POST">
                <div class="mb-1">
                    <input type="text" class="form-control" name="nombreConsulta" value="<?= $busqueda ?>"
                        placeholder="Con escribir un par de letras basta">
                </div>
                <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
                    <a href="../crud.php" class="btn btn-info">Regresar a todos los registros(Inicio)</a>
                    <input type="submit" value="Buscar por nombre" class="btn btn-primary" name="btnConsulta" />
                </div>
            </form>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Nacimiento</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultados as $item) {  ?>
                <tr>
                    <td><?php echo $item->nombre; ?></td>
                    <td><?php echo $item->apellido; ?></td>
                    <td><?php echo $item->nacimiento; ?></td>
                    <td id="tdd"><?php echo $item->correo; ?></td>
                    <td>
                        <a href="Controlador/modificarForm.php?id=<?php echo $item->_id; ?>"
                            class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a onclick="return eliminar()" href="crud.php?id=<?php echo $item->_id; ?>"
                            class="btn btn-small btn-danger" name="btnEliminar"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php }
                        ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src=https://kit.fontawesome.com/646ac4fad6.js crossorigin="anonymous"></script>
</body>

</html>