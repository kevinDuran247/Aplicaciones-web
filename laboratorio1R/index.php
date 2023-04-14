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
    <style>
        .custom-hover:hover {
            background-color: #090081;
            border-radius: 10%;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav m-1">
                    <li class="nav-item">
                        <a class="nav-link text-white custom-hover" href="equipos">Equipos</a>
                </ul>
                <ul class="navbar-nav m-1">
                    <li class="nav-item">
                        <a class="nav-link text-white custom-hover" href="universidades">Universidades</a>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <?php
        if(isset($_GET["url"])){
            require_once($_GET["url"].".php");
        }else{
            ?>
            <div class="container my-2 py-2">
                <div class="row">
                    <div class="col">
                        <h3>Equipo: </h3>
                        <p>Rosmery Cuéllar</p>
                        <p>Kevin Durán</p>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
    </main>
</body>

</html>