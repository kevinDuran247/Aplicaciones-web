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
        <h5>Agregar o quitar universidades</h5>
        <form method="POST">
            <div class="mb-3 p-3">
                <label class="form-label">Nombre de equipo:</label>
                <input type="text" class="form-control" id="nombre" name="universidad" required><br>
                <button type="submit" class="btn btn-success" name="OK2">Agregar universidad</button>
            </div>
        </form>

        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Universidad</th>
                    <th scope="col">Quitar</th>
                    <th scope="col">Modificar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_POST["OK2"])) {
                    $universidad = $_POST["universidad"];

                    if(isset($_SESSION["universidades"])){
                        $_SESSION["universidades"][] = $universidad;
                    } else {
                        $_SESSION["universidades"] = array($universidad);
                    }
                }

                if(isset($_POST["eliminar"])){
                    $indice = $_POST["eliminar"];
                    unset($_SESSION["universidades"][$indice]);
                }
                if (isset($_POST["modificar"])) {
                    $indice = $_POST["modificar"];
                    $nuevoNombre = $_POST["nuevoNombre"];
                    $_SESSION["universidades"][$indice] = $nuevoNombre;
                }

            if(isset($_SESSION["universidades"])){
                foreach($_SESSION["universidades"] as $key => $valor){
                    echo "
                    <tr>
                        <td>".($key+1)."</td>
                        <td>".$valor."</td>
                        <td> 
                            <form method='POST' id='form_eliminar'>
                                <input type='hidden' name='eliminar' value='".$key."'>
                                <button type='submit' class='btn btn-danger'>Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='modificar' value='".$key."' />
                                <input type='text' name='nuevoNombre' placeholder='Nuevo nombre' required />
                                <button type='submit' class='btn btn-warning'>Modificar</button>
                            </form>
                        </td>
                    </tr>";
                }
            }

            
            ?>
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