<?php 
session_start();
$nEquipo = $_GET['key']; //toma el nombre del equipo de equipos.php
$imagenEquipo = $_GET['imagenEquipo'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 1 - DAW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </link>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center p-2">
            <h3>Agregar Jugadores: <?php echo $nEquipo;?></h3>
            <form method="POST">
                <select name="equipoSelect" class="form-select" aria-label="Default select example"
                    onchange="this.form.submit()">
                    <option value="" disabled selected><?php echo $nEquipo;?></option>
                    <?php
                        foreach ($_SESSION["equipos"] as $key=>$valor) {
                            echo "<option value='" . $key . "|" . $valor . "'>" . $key . "</option>";
                        }
                    ?>
                </select>
                <?php
                    if (isset($_POST["equipoSelect"])) {
                        $seleccion = explode("|", $_POST["equipoSelect"]);
                        $key = $seleccion[0];
                        $valor = $seleccion[1];
                        
                        $redirect_url = "jugadores?key=".urlencode($key)."&imagenEquipo=".urlencode($valor);
                        header("Location: $redirect_url");
                    }
                ?>
            </form>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 p-3">
                <label class="form-label">Nombre del Jugador:</label>
                <input type="text" class="form-control" id="nombre" name="nJugador" required>
                <label for="imagen" class="form-label">Foto:</label>
                <input type="file" class="form-control" id="imagen" name="fichero" required>
                <label class="form-label">Seleccione Posición:</label>
                <select class="form-select" aria-label="Default select example" name="posicion">
                    <option selected>Posicion</option>
                    <option value="BASE">Base</option>
                    <option value="ESCOLTA">Escolta</option>
                    <option value="ALERO">Alero</option>
                    <option value="ALA-PIVOT">Ala-Pivot</option>
                    <option value="PIVOT">Pivot</option>
                </select>
                <label class="form-label">Edad:</label>
                <input type="number" min="8" max="99" class="form-control" name="edad" required>
                <label class="form-label">Estatura en metros:</label>
                <input type="number" min="1.00" max="2.99" step="0.01" class="form-control" name="estatura" placeholder="0.00 m" required>
                <label class="form-label">Peso en lb:</label>
                <input type="number" min="1.00" max="299.99" step="0.01" class="form-control" name="peso" required placeholder="000.00 lb"><br>
                <select name="universidad" class="form-select" aria-label="Default select example">
                    <option value="" disabled selected>Selecciona una universidad</option>
                    <?php
                        foreach ($_SESSION["universidades"] as $indice => $universidad) {
                            echo "<option value='" . $indice . "'>" . $universidad . "</option>";
                        }
                    ?>
                </select><br>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-success" name="OK1">Agregar jugador</button>
                    <?php echo "<img src='$imagenEquipo' class='img-thumbnail' style='width: 250px; height: auto;'>"?>
                </div>   
            </div>
        </form>

        
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre jugador</th>
                    <th>Foto</th>
                    <th>Posicion</th>
                    <th>Edad</th>
                    <th>Estatura</th>
                    <th>Peso</th>
                    <th>Universidad</th>
                    <th>Quitar</th>

                </tr>
            </thead>
            <tbody>

            <?php
            $imagenJugador="";
            if (isset($_POST["OK1"])) {
                if (isset($_FILES["fichero"])){
                    if (is_uploaded_file ($_FILES['fichero']['tmp_name'])){ 
                        //nombre temporal del fichero
                        $tmp_name = $_FILES["fichero"]["tmp_name"];
                        //nombre completo del archivo
                        //crear una carpeta con el nombre imagenes en la misma carpeta
                        //donde se encuentra el archivo subir.php
                        $imagenJugador = "imgJugadores/".$_FILES["fichero"]["name"];
                        
                        //pregunto si existe el ficheo
                        if (is_file($imagenJugador)) {
                            $idUnico=time();//si existe le coloco un nombre unico
                            $imagenJugador = "imgJugadores/".$idUnico."-".$_FILES["fichero"]["name"];        
                        }
                        //funcion para mover el fichero a la ruta que especifiquemos
                        move_uploaded_file($tmp_name,$imagenJugador);
                        print("Cargado");
                    }else{
                        echo "No se ha podido subir el fichero\n";
                    }
                } 

                $nJugador = $_POST["nJugador"];
                $posicion = $_POST["posicion"];
                $edad = $_POST["edad"];
                $estatura = $_POST["estatura"];
                $peso = $_POST["peso"];
                $universidad = $_POST["universidad"];

                if(isset($_SESSION[$nEquipo])){
                    $jugadores = $_SESSION[$nEquipo];
                    if(count($jugadores) < 2){
                        $jugadores[$nJugador] = array('imagenJugador' => $imagenJugador, 'posicion' => $posicion, 'edad' => $edad, 'estatura' => $estatura, 'peso' => $peso, 'universidad' => $universidad); 
                        $_SESSION[$nEquipo] = $jugadores;
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>No se permiten más de 15 jugadores en el equipo</div>";
                    }
                    
                } else {
                    $jugadores[$nJugador] = array('imagenJugador' => $imagenJugador, 'posicion' => $posicion, 'edad' => $edad, 'estatura' => $estatura, 'peso' => $peso, 'universidad' => $universidad);
                    $_SESSION[$nEquipo] = $jugadores;
                    //session_destroy();                  
                }
            }

            if(isset($_POST["eliminar"])){
                $keyEliminar = $_POST["eliminar"];
                unset($_SESSION[$nEquipo][$keyEliminar]);
            }

            if(isset($_SESSION[$nEquipo])){
                $contador = 0;
                if(count($_SESSION[$nEquipo]) < 5){
                    echo "<div class='alert alert-warning' role='alert'>Se nesecitan mas de 5 jugadores para conformar el equipo</div>";
                }
                foreach($_SESSION[$nEquipo]  as $key=>$valor){
                    $contador++;
                    echo "
                    <tr>
                        <td>$contador</td>                  
                        <td>$key</td>
                        <td><img src='".$valor['imagenJugador']."' class='img-thumbnail' style='width: 100px; height: auto;'></td>
                        <td>".$valor['posicion']."</td>
                        <td>".$valor['edad']." años</td>
                        <td>".$valor['estatura']." m</td>
                        <td>".$valor['peso']." lb</td>
                        <td>".$_SESSION["universidades"][$valor['universidad']]."</td>
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
        <div>
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