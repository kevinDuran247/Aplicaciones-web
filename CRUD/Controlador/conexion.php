<?php
$conn = new mysqli("localhost","root","","estudiante");
$conn -> set_charset("utf8");

if (mysqli_connect_errno()) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
}
?>