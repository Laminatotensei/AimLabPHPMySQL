<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo perfil de juego</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/1382257960.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estilos.css">

    <style>

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
    
    <form class="formulario" method="get" action="perfil_sql.php">

        <img src="../logo.jpg">
        <h1> Ingrese datos del perfil </h1>

        <div class="contenedor">

            <div class="input-contenedor">
                <i class="fas fa-file-signature"></i>
                <td><input type="text" placeholder="Nombre del perfil" name="n_perfil" id="n_perfil"></td>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-mouse"></i>
                <td><input type="number" placeholder="DPI" name="dpi" id="dpi" required></td>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-sort-numeric-up-alt"></i>
                <td><input type="number" placeholder="Sensibilidad" name="sens" id="sens" step="0.001" required></td>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-gamepad"></i>
                <td><input type="text" value="VALORANT" placeholder="Juego" name="juego" id="juego" readonly></td>
            </div>

            <td><input type="submit" name="crear" id="crear" value="Crear" class="button"></td><br><br>

            <a class="boton2" href="Seleccion_juegos.php"> Volver </a>

        </div>

    </form>

</body>
</html>