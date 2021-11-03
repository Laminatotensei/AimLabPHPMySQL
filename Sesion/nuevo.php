<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva sesion de juego</title>

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

        .gridshot {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("gridshot.gif");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .gridshot:hover {
            background: cadetblue;
            height: 70px;  
        }

        .spidershot {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("spidershot.gif");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .spidershot:hover {
            background: cadetblue;
            height: 70px;  
        }

        .microshot {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 150px;
            color: white;
            font-size: 40px;
            background-image: url("microshot.gif");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .microshot:hover {
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
        <h1>Seleccione un entrenamiento</h1>

        <div class="cotenedor">

            <a class="gridshot" href="N_Sesion_Grid.php"> GRIDSHOT </a>
            <a class="spidershot" href="N_Sesion_Spider.php"> SPIDERSHOT </a>
            <a class="microshot" href="N_Sesion_Micro.php"> MICROSHOT </a><br><br>

            <a class="boton2" href="../bienvenido.php"> Volver </a>
        
        </div>

    </form>

</body>
</html>