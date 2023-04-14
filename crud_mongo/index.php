<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilosLogin/style.css">
    <title>Login</title>
</head>
<body>
    <header><h1>BIENVENIDO AL MEGA SISTEMA CRUD DE KEVIN DURANIO</h1></header>
    <div class="form">
        <form method="POST" action="">
            <br>
            <input type="text" name="user" placeholder="USUARIO">
            <br>
            <br>
            <input type="password" name="password" placeholder="CONTRASEÑA">
            <br>
            <br>
            <?php 
                require_once "./clases/conexion.php";
                include "Controlador/login.php";
            ?>
            <input type="submit" value="ENTRAR" name="entrar">
        </form>
    </div>
</body>
</html>