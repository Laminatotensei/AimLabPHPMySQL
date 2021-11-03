<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo perfil de juego</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../estilos.css">

    <style>

        .formulario1 {
            background: #fff;
            margin-top: 150px;
            padding: 3px;
        }

        @media(min-width: 768px)
        {
            .formulario1 {
            margin: auto;
            width: 700px;
            margin-top: 150px;
            border-radius: 2%;
            }
        }

        .valorant {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("valorant.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .valorant:hover {
            background: cadetblue;
            height: 70px;  
        }

        .apex {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("apex_legends.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .apex:hover {
            background: cadetblue;
            height: 70px;
        }

        .csgo {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("csgo.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .csgo:hover {
            background: cadetblue;
            height: 70px;
        }

        .warzone {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("warzone.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .warzone:hover {
            background: cadetblue;
            height: 70px;
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

    <form class="formulario1">
    
        <img src="../logo.jpg">
        <h1>Seleccione un juego</h1>

        <div class="cotenedor">

            <a class="valorant" href="N_Perfil_VALORANT.php"> VALORANT </a>
            <a class="apex" href="N_Perfil_APEX.php"> APEX LEGENDS </a>
            <a class="csgo" href="N_Perfil_CSGO.php"> CS:GO </a>
            <a class="warzone" href="N_Perfil_WARZONE.php"> WARZONE </a><br><br>

            <a class="boton2" href="perfil.php"> Volver </a>
        
        </div>

    </form>

</body>
</html>