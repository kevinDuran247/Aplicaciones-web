<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 1 - DAW</title>
</head>

<body>
    <?php
        session_start();
    ?>
    <div class="container">
        <br>
        <h5>Agregar equipos de basquetbol</h5>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 p-3">
                <label class="form-label">Nombre de equipo:</label>
                <input type="text" class="form-control" id="nombre" name="txtnombre" required>
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="fichero" required><br>
                <button type="submit" class="btn btn-success" name="OK1">Agregar equipo</button>
            </div>
        </form>

        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre equipo</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Ver Jugadores</th>
                    <th scope="col">Quitar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $imagenarchivo="";
                    if (isset($_POST["OK1"])) {
                        if (isset($_FILES["fichero"])){
                            if (is_uploaded_file ($_FILES['fichero']['tmp_name'])){ 
                                //nombre temporal del fichero
                                $tmp_name = $_FILES["fichero"]["tmp_name"];
                                //nombre completo del archivo
                                //crear una carpeta con el nombre imagenes en la misma carpeta
                                //donde se encuentra el archivo subir.php
                                $imagenarchivo = "imagenes/".$_FILES["fichero"]["name"];
                                
                                //pregunto si existe el ficheo
                                if (is_file($imagenarchivo)) {
                                    $idUnico=time();//si existe le coloco un nombre unico
                                    $imagenarchivo = "imagenes/".$idUnico."-".$_FILES["fichero"]["name"];        
                                }
                                //funcion para mover el fichero a la ruta que especifiquemos
                                move_uploaded_file($tmp_name,$imagenarchivo);
                                print("Fichero subido con exito");
                            }else{
                                echo "No se ha podido subir el fichero\n";
                            }
                        } 

                        $nombreEquipo = $_POST["txtnombre"];

                        if(isset($_SESSION["equipos"])){
                            $equipos=$_SESSION["equipos"];
                            $equipos[$nombreEquipo]=$imagenarchivo;
                            $_SESSION["equipos"]=$equipos;
                        }else{
                            $equipos[$nombreEquipo]=$imagenarchivo;
                            $_SESSION["equipos"]=$equipos;
                        }
                    }

                    if(isset($_POST["eliminar"])){
                        $keyEliminar = $_POST["eliminar"];
                        unset($_SESSION["equipos"][$keyEliminar]);
                    }
                    
                    if(isset($_SESSION["equipos"])){
                        $contador = 0;
                        foreach($_SESSION["equipos"]  as $key=>$valor){
                            $contador++;
                            echo "
                            <tr>
                                <th scope='row'>$contador</th>
                                <td>$key</td>
                                <td><img src='$valor' class='img-thumbnail img-fluid' style='width: 75px; height: auto;'></td>
                                <td><a href='jugadores?key=$key&imagenEquipo=$valor' class='btn btn-small btn-success'>Administrar</a></td>
                                <td>
                                    <form method='POST' id='form_eliminar'>
                                        <input type='hidden' name='eliminar' value='$key'>
                                        <button type='submit' class='btn btn-small btn-danger'>Eliminar</button>
                                    </form>
                                </td>
                            </tr>";
                        }               
                    }
                    //session_destroy();    
                ?>

            </tbody>
        </table>
    </div>
</body>
<script>
    document.addEventListener("submit", function(event){
        if(event.target.id == "form_eliminar"){
            event.preventDefault();
            var form = event.target;
            var result = confirm("¿Estas seguro de eliminar este jugador?");
            if(result){
                form.submit();
            }
        }
    });
</script>
</html>