<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Perfil</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../estilos.css">
    <script src="https://kit.fontawesome.com/1382257960.js" crossorigin="anonymous"></script>

    <style> 

        .botones {
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border: none;
            width: 95%;
            height: 50px;
            color: white;
            font-size: 20px;
            background-color: #1a2537;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .botones:hover {
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

        $busqueda_id = $_SESSION["id"];

        try {

            $base = new PDO('mysql:host=localhost; dbname=aimlabprueba', 'root', '');
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");

            $sql = "SELECT ID, NOMBRE, DPI, SENS, EDPI, JUEGO FROM PERFIL_DE_JUEGO WHERE ID_USUARIO = :id_u";

            $resultado = $base->prepare($sql);
            $resultado->execute(array(":id_u" => $busqueda_id));

            echo "<form class='formulario'>
                    <img src='../logo.jpg'>
                    <h1> Seleccione un perfil </h1>
                    <br>";

            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

                echo "<h1>--------------------------------</h1>";
                echo"<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Nombre: " . $registro['NOMBRE'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-mouse'></i>
                            <input type='text' value='DPI: " . $registro['DPI'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <td><input type='text' value='Sensibilidad: " . $registro['SENS'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-calculator'></i>
                            <input type='text' value='eDPI: " . $registro['EDPI'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-gamepad'></i>
                            <input type='text' value='Juego: " . $registro['JUEGO'] . "' readonly>
                        </div>

                        <a class='botones' href='N_Sesion_Spider_SQL.php?id=" . $registro['ID'] ."'> SELECCIONAR </a>

                    </div>";
                    echo "<h1>--------------------------------</h1>";
                echo "<br><br>";

            }

            echo "<br><br> <a class='boton2' href='nuevo.php'> Volver </a>";
            echo "</form>";

            $resultado->closeCursor();

        } catch(Exception $e) {

            die ('Error: ' . $e->getMessage());

        }

        $base = null;

    ?>

    

</body>
</html>