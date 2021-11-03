<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de juego</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../estilos.css">

    <style>

        .boton1 {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            color: white;
            font-size: 20px;
            background: #1a2537;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .boton1:hover {
            background: cadetblue;
        }

        .boton2 {
            text-decoration: none;
            padding: 10px;
            font-weight: 600;
            font-size: 20px;
            color: white;
            background-color: #1a2537;
            border-radius: 6px;
            cursor: pointer;
        }

        .boton2:hover {
            background-color: cadetblue;
        }

    </style>

</head>
<body>
    
    <?php

        session_start();

        if (!isset($_SESSION["usuario"])) {
            header("location:index.php");
        }

    ?>

    <form class="formulario">

        <img src="../logo.jpg">
        <h1> Perfil de juego </h1>
        <br>

        <a class="boton1" href="seleccion_juegos.php"> Crear perfil de juego </a>
        <a class="boton1" href="V_Perfiles.php"> Ver perfiles de juego </a><br><br><br><br>

        <a class="boton2" href="../bienvenido.php"> Volver </a>

    </form>

</body>
</html>