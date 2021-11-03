<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Perfiles</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../estilos.css">
    <script src="https://kit.fontawesome.com/1382257960.js" crossorigin="anonymous"></script>

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

        require("../datos_conexion.php");

        $usuario_id = $_SESSION["id"];

        $Sesion = $_GET['sesion'];

        try {

            $base = new PDO('mysql:host=localhost; dbname=aimlabprueba', 'root', '');
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");

            $mysqli = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

            if ($Sesion == 1) {

                $sql = "SELECT * FROM SESION_GRID WHERE N_VUELTAS = 1";

                $ultimo_registro = $_GET['u_vuelta'];

            }

            if ($Sesion == 2) {

                $sql = "SELECT * FROM SESION_SPIDER WHERE N_VUELTAS = 1";

                $ultimo_registro = $_GET['u_vuelta'];

            }

            if ($Sesion == 3) {

                $sql = "SELECT * FROM SESION_MICRO WHERE N_VUELTAS = 1";

                $ultimo_registro = $_GET['u_vuelta'];

            }

            $resultado = $base->prepare($sql);
            $resultado->execute();

            $registro = $resultado->fetch();

            echo "<form class='formulario1'>
                    <img src='../logo.jpg'>
                    <h1> Resultados </h1>
                    <br>";

            echo "<h1>--------------------------------</h1>";

            echo "<div class='contenedor'>
        
                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Primer puntaje: " . $registro['_Puntaje'] . "' readonly>
                    </div>

                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Primer precision: " . $registro['_Precision'] . "' readonly>
                    </div>";

                    //$resultado->closeCursor();

                    if ($Sesion == 1) {

                        $sql_ultimo = "SELECT * FROM SESION_GRID WHERE N_VUELTAS = '$ultimo_registro'";
                        $resultado_ultimo = $base->prepare($sql_ultimo);

                        $resultado_ultimo -> execute();

                        $registro_ultimo = $resultado_ultimo->fetch();

                    }

                    if ($Sesion == 2) {

                        $sql_ultimo = "SELECT * FROM SESION_SPIDER WHERE N_VUELTAS = '$ultimo_registro'";
                        $resultado_ultimo = $base->prepare($sql_ultimo);

                        $resultado_ultimo -> execute();

                        $registro_ultimo = $resultado_ultimo->fetch();

                    }

                    if ($Sesion == 3) {

                        $sql_ultimo = "SELECT * FROM SESION_MICRO WHERE N_VUELTAS = '$ultimo_registro'";
                        $resultado_ultimo = $base->prepare($sql_ultimo);

                        $resultado_ultimo -> execute();

                        $registro_ultimo = $resultado_ultimo->fetch();

                    }


            echo    "<div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Ultimo puntaje: " . $registro_ultimo['_Puntaje'] . "' readonly>
                    </div>
                    
                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Ultimo precision: " . $registro_ultimo['_Precision'] . "' readonly>
                    </div>
                    
                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Mejor puntaje: " . $registro_ultimo['M_Puntaje'] . "' readonly>
                    </div>
                    
                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Mejor Precision: " . $registro_ultimo['M_Precision'] . "' readonly>
                    </div>
                    
                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Promedio puntaje: " . $registro_ultimo['P_Puntaje'] . "' readonly>
                    </div>
                    
                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <input type='text' value='Promedio Precision: " . $registro_ultimo['P_Precision'] . "' readonly>
                    </div>";

            echo "</div>";

            echo "<h1>--------------------------------</h1>";

            echo "<h1> Sus estadisticas </h1><br>";

            if ($Sesion == 1) {
                $perfil_sql = "SELECT * FROM PERFIL_GRID WHERE ID_USUARIO = '$usuario_id'";
                $perfil_resultado = $base->prepare($perfil_sql);

                $perfil_resultado -> execute();

                $perfil_registro = $perfil_resultado->fetch();

                if ($registro_ultimo['M_Puntaje'] > $perfil_registro['M_Puntaje']) {

                    $m_puntaje = $registro_ultimo['M_Puntaje'];
                    $m_precision = $registro_ultimo['M_Precision'];
                    $id_perfil_juego = $registro_ultimo['id_perfil_juego'];

                    $cambio_sql = "UPDATE PERFIL_GRID 
                                   SET M_PUNTAJE = '$m_puntaje', M_PRECISION = '$m_precision', ID_M_PERFIL = '$id_perfil_juego'
                                   WHERE ID_USUARIO = '$usuario_id'";

                    $resultado = $base->prepare($cambio_sql);
                    $resultado->execute();

                    $m_puntaje_p = $perfil_registro['M_Puntaje'];
                    $m_precision_p = $perfil_registro['M_Precision'];
                    $id_perfil_juego_p = $perfil_registro['id_M_Perfil'];

                    $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego'";
                    $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                    $perfil_juego_resultado -> execute();
                    
                    $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                    $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                    echo 
                    "<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record puntaje: " . $m_puntaje . " (NUEVO RECORD)' readonly>
                        </div>
                          
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record precision: " . $m_precision . " (NUEVO RECORD)' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Mejor perfil: " . $nombre_perfil_juego . " (PERFIL DEL NUEVO RECORD)' readonly>
                        </div>
                    
                    </div>";

                }

                else {

                    $m_puntaje_p = $perfil_registro['M_Puntaje'];
                    $m_precision_p = $perfil_registro['M_Precision'];
                    $id_perfil_juego_p = $perfil_registro['id_M_Perfil'];

                    $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego_p'";
                    $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                    $perfil_juego_resultado -> execute();
                    
                    $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                    $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                    echo 
                    "<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record puntaje: " . $m_puntaje_p . "' readonly>
                        </div>
                          
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record precision: " . $m_precision_p . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Mejor perfil: " . $nombre_perfil_juego . "' readonly>
                        </div>
                    
                    </div>";

                }
            }

            if ($Sesion == 2) {
                $perfil_sql = "SELECT * FROM PERFIL_SPIDER WHERE ID_USUARIO = '$usuario_id'";
                $perfil_resultado = $base->prepare($perfil_sql);

                $perfil_resultado -> execute();

                $perfil_registro = $perfil_resultado->fetch();

                if ($registro_ultimo['M_Puntaje'] > $perfil_registro['M_Puntaje']) {

                    $m_puntaje = $registro_ultimo['M_Puntaje'];
                    $m_precision = $registro_ultimo['M_Precision'];
                    $id_perfil_juego = $registro_ultimo['id_perfil_juego'];

                    $cambio_sql = "UPDATE PERFIL_SPIDER 
                                   SET M_PUNTAJE = '$m_puntaje', M_PRECISION = '$m_precision', ID_M_PERFIL = '$id_perfil_juego'
                                   WHERE ID_USUARIO = '$usuario_id'";

                    $resultado = $base->prepare($cambio_sql);
                    $resultado->execute();

                    $m_puntaje_p = $perfil_registro['M_Puntaje'];
                    $m_precision_p = $perfil_registro['M_Precision'];
                    $id_perfil_juego_p = $perfil_registro['id_M_Perfil'];

                    $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego'";
                    $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                    $perfil_juego_resultado -> execute();
                    
                    $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                    $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                    echo 
                    "<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record puntaje: " . $m_puntaje . " (NUEVO RECORD)' readonly>
                        </div>
                          
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record precision: " . $m_precision . " (NUEVO RECORD)' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Mejor perfil: " . $nombre_perfil_juego . " (PERFIL DEL NUEVO RECORD)' readonly>
                        </div>
                    
                    </div>";

                }

                else {

                    $m_puntaje_p = $perfil_registro['M_Puntaje'];
                    $m_precision_p = $perfil_registro['M_Precision'];
                    $id_perfil_juego_p = $perfil_registro['id_M_Perfil'];

                    $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego_p'";
                    $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                    $perfil_juego_resultado -> execute();
                    
                    $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                    $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                    echo 
                    "<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record puntaje: " . $m_puntaje_p . "' readonly>
                        </div>
                          
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record precision: " . $m_precision_p . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Mejor perfil: " . $nombre_perfil_juego . "' readonly>
                        </div>
                    
                    </div>";

                }
            }

            if ($Sesion == 3) {
                $perfil_sql = "SELECT * FROM PERFIL_MICRO WHERE ID_USUARIO = '$usuario_id'";
                $perfil_resultado = $base->prepare($perfil_sql);

                $perfil_resultado -> execute();

                $perfil_registro = $perfil_resultado->fetch();

                if ($registro_ultimo['M_Puntaje'] > $perfil_registro['M_Puntaje']) {

                    $m_puntaje = $registro_ultimo['M_Puntaje'];
                    $m_precision = $registro_ultimo['M_Precision'];
                    $id_perfil_juego = $registro_ultimo['id_perfil_juego'];

                    $cambio_sql = "UPDATE PERFIL_MICRO 
                                   SET M_PUNTAJE = '$m_puntaje', M_PRECISION = '$m_precision', ID_M_PERFIL = '$id_perfil_juego'
                                   WHERE ID_USUARIO = '$usuario_id'";

                    $resultado = $base->prepare($cambio_sql);
                    $resultado->execute();

                    $m_puntaje_p = $perfil_registro['M_Puntaje'];
                    $m_precision_p = $perfil_registro['M_Precision'];
                    $id_perfil_juego_p = $perfil_registro['id_M_Perfil'];

                    $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego'";
                    $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                    $perfil_juego_resultado -> execute();
                    
                    $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                    $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                    echo 
                    "<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record puntaje: " . $m_puntaje . " (NUEVO RECORD)' readonly>
                        </div>
                          
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record precision: " . $m_precision . " (NUEVO RECORD)' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Mejor perfil: " . $nombre_perfil_juego . " (PERFIL DEL NUEVO RECORD)' readonly>
                        </div>
                    
                    </div>";

                }

                else {

                    $m_puntaje_p = $perfil_registro['M_Puntaje'];
                    $m_precision_p = $perfil_registro['M_Precision'];
                    $id_perfil_juego_p = $perfil_registro['id_M_Perfil'];

                    $sql_perfil_juego = "SELECT * FROM PERFIL_DE_JUEGO WHERE ID = '$id_perfil_juego_p'";
                    $perfil_juego_resultado = $base->prepare($sql_perfil_juego);

                    $perfil_juego_resultado -> execute();
                    
                    $perfil_juego_regristro = $perfil_juego_resultado->fetch();

                    $nombre_perfil_juego = $perfil_juego_regristro['nombre'];

                    echo 
                    "<div class='contenedor'>
        
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record puntaje: " . $m_puntaje_p . "' readonly>
                        </div>
                          
                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Record precision: " . $m_precision_p . "' readonly>
                        </div>

                        <div class='input-contenedor'>
                            <i class='fas fa-file-signature'></i>
                            <input type='text' value='Mejor perfil: " . $nombre_perfil_juego . "' readonly>
                        </div>
                    
                    </div>";

                }
            }

            echo "<br><br>";


            echo "<br><br> <a class='boton2' href='../bienvenido.php'> Volver </a>";
            echo "</form>";

            $resultado->closeCursor();

            if ($Sesion == 1){
                mysqli_select_db($mysqli, $db_nombre);
                mysqli_query($mysqli, "TRUNCATE TABLE SESION_GRID");
            }

            if ($Sesion == 2){
                mysqli_select_db($mysqli, $db_nombre);
                mysqli_query($mysqli, "TRUNCATE TABLE SESION_SPIDER");
            }

            if ($Sesion == 3){
                mysqli_select_db($mysqli, $db_nombre);
                mysqli_query($mysqli, "TRUNCATE TABLE SESION_MICRO");
            }

            mysqli_close($mysqli);

        } catch(Exception $e) {

            die ('Error: ' . $e->getMessage());

        }

        $base = null;

    ?>

    

</body>
</html>