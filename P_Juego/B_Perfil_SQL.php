<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Borrado</title>
    </head>
    
    <body>
    
        <?php

            session_start();

            if (!isset($_SESSION["usuario"])) {
                header("location:index.php");
            }

            $id = $_GET["id"];
            $nombre = $_GET["n_perfil"];
            $dpi = $_GET["dpi"];
            $sens = $_GET["sens"];
            $edpi = $dpi * $sens;
            $juego = $_GET["juego"];

            require("../datos_conexion.php");

            $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

            if (mysqli_connect_errno()) {
                echo "Fallo al conectar con la BBDD";
                exit();
            }

            mysqli_select_db($conexion, $db_nombre) or die("No se encontro la BBDD");
            mysqli_set_charset($conexion, "utf8");

            $consulta = "DELETE FROM PERFIL_DE_JUEGO WHERE ID = '$id'";
            $resultados = mysqli_query($conexion, $consulta);

            if ($resultados == false){
                echo "Error en la consulta";
            }

            else {
                //echo "Registro eliminado <br>";

                //echo mysqli_affected_rows($conexion);

                if (mysqli_affected_rows($conexion) == 0) {
                    echo "No hay registros que eliminar con ese criterio";
                }

                else{
                    echo "Se han eliminado " . mysqli_affected_rows($conexion) . " registros";
                }
            }

            mysqli_close($conexion);

            echo "<p>Tu perfil esta listo<a class='link' href='../bienvenido.php'> Pantalla de inicio</a></p>";

        ?>

    </body>
</html>