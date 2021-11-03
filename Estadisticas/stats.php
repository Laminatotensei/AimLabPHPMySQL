<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadisticas</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../estilos.css">
    <script src="https://kit.fontawesome.com/1382257960.js" crossorigin="anonymous"></script>

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

        $busqueda_id = $_SESSION["id"];

        try {

            $base = new PDO('mysql:host=localhost; dbname=aimlabprueba', 'root', '');
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");

            $sql_grid = "SELECT M_PUNTAJE, M_PRECISION, ID_M_PERFIL FROM PERFIL_GRID WHERE ID_USUARIO = :id_u";
            $sql_spider = "SELECT M_PUNTAJE, M_PRECISION, ID_M_PERFIL FROM PERFIL_SPIDER WHERE ID_USUARIO = :id_u";
            $sql_micro = "SELECT M_PUNTAJE, M_PRECISION, ID_M_PERFIL FROM PERFIL_MICRO WHERE ID_USUARIO = :id_u";

            $resultado_grid = $base->prepare($sql_grid);
            $resultado_spider = $base->prepare($sql_spider);
            $resultado_micro = $base->prepare($sql_micro);
            
            $resultado_grid->execute(array(":id_u" => $busqueda_id));
            $resultado_spider->execute(array(":id_u" => $busqueda_id));
            $resultado_micro->execute(array(":id_u" => $busqueda_id));

            $n_registros_grid = $resultado_grid->rowCount();
            $n_registros_spider = $resultado_spider->rowCount();
            $n_registros_micro = $resultado_micro->rowCount();

            echo "<form class='formulario'>
                    <img src='../logo.jpg'>
                    <h1> Estadisticas </h1>
                    <br>";

            if ($n_registros_grid != 0) {

                while($registro = $resultado_grid->fetch(PDO::FETCH_ASSOC)) {

                    echo "<h1>--------------------------------</h1>";
                    echo "<h1> GRIDSHOT </h1>";
                    echo"<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <input type='text' value='Record Puntaje: " . $registro['M_PUNTAJE'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <input type='text' value='Record precision: " . $registro['M_PRECISION'] . "' readonly>
                        </div>";

                        $id_perfil_juego = $registro['ID_M_PERFIL'];

                        $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego'";
                        $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                        $perfil_juego_resultado -> execute();
                    
                        $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                        $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                        echo
                        "<div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <td><input type='text' value='Mejor perfil: " . $nombre_perfil_juego . "' readonly>
                        </div>";

                        $perfil_juego_resultado->closeCursor();
    
                    echo "</div>";
                    echo "<h1>--------------------------------</h1>";
                    echo "<br><br>";

                }

                $resultado_grid->closeCursor();

            }

            if ($n_registros_spider != 0) {

                while($registro = $resultado_spider->fetch(PDO::FETCH_ASSOC)) {

                    echo "<h1>--------------------------------</h1>";
                    echo "<h1> SPIDERSHOT </h1>";
                    echo"<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <input type='text' value='Record Puntaje: " . $registro['M_PUNTAJE'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <input type='text' value='Record precision: " . $registro['M_PRECISION'] . "' readonly>
                        </div>";

                        $id_perfil_juego = $registro['ID_M_PERFIL'];

                        $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego'";
                        $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                        $perfil_juego_resultado -> execute();
                    
                        $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                        $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                        echo
                        "<div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <td><input type='text' value='Mejor perfil: " . $nombre_perfil_juego . "' readonly>
                        </div>";

                        $perfil_juego_resultado->closeCursor();

                    echo "</div>";
                    echo "<h1>--------------------------------</h1>";
                    echo "<br><br>";

                }
                
                $resultado_spider->closeCursor();

            }

            if ($n_registros_micro != 0) {

                while($registro = $resultado_micro->fetch(PDO::FETCH_ASSOC)) {

                    echo "<h1>--------------------------------</h1>";
                    echo "<h1> MICROSHOT </h1>";
                    echo"<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <input type='text' value='Record Puntaje: " . $registro['M_PUNTAJE'] . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-sort-numeric-up-alt'></i>
                            <input type='text' value='Record precision: " . $registro['M_PRECISION'] . "' readonly>
                        </div>";

                        $id_perfil_juego = $registro['ID_M_PERFIL'];

                        $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego'";
                        $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                        $perfil_juego_resultado -> execute();
                    
                        $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                        $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                        echo
                        "<div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <td><input type='text' value='Mejor perfil: " . $nombre_perfil_juego . "' readonly>
                        </div>";

                        $perfil_juego_resultado->closeCursor();

                    echo "</div>";
                    echo "<h1>--------------------------------</h1>";
                    echo "<br><br>";

                }
                
                $resultado_micro->closeCursor();

            }

            echo "<br><br> <a class='boton2' href='../bienvenido.php'> Volver </a>";
            echo "</form>";

            $resultado_grid->closeCursor();
            $resultado_spider->closeCursor();
            $resultado_micro->closeCursor();

        } catch(Exception $e) {

            die ('Error: ' . $e->getMessage());

        }

        $base = null;

    ?>

    

</body>
</html>