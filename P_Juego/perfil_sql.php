<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Creacion</title>
</head>
<body>

    <?php

        session_start();

        if (!isset($_SESSION["usuario"])) {
            header("location:index.php");
        }

        // Variables de registro
        $id = $_SESSION["id"];
        $nombre = $_GET["n_perfil"];
        $dpi = $_GET["dpi"];
        $sens = $_GET["sens"];
        $edpi = $dpi * $sens;
        $juego = $_GET["juego"];

        // Conexion
        require("../datos_conexion.php");

        $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la BBDD";
            exit();
        }

        mysqli_select_db($conexion, $db_nombre) or die("No se encontro la BBDD");
        mysqli_set_charset($conexion, "utf8");

        // Registro
        $consulta = "INSERT INTO PERFIL_DE_JUEGO (ID_USUARIO, NOMBRE, DPI, SENS, EDPI, JUEGO) VALUE ('$id', '$nombre', $dpi, $sens, $edpi, '$juego')";
        $resultados = mysqli_query($conexion, $consulta);

        if ($resultados == false) {
            echo "Error en el registro";
        }

        else {
            echo "Resgistro guardado<br><br>";

            echo "<table>";
            echo "<tr><td>$id</td></tr>";
            echo "<tr><td>$nombre</td></tr>";
            echo "<tr><td>$dpi</td></tr>";
            echo "<tr><td>$sens</td></tr>";
            echo "<tr><td>$edpi</td></tr>";
            echo "<tr><td>$juego</td></tr>";
            echo "</table>";
        }

        mysqli_close($conexion);

        echo "<p>Tu perfil esta listo<a class='link' href='../bienvenido.php'> Pantalla de inicio</a></p>";
    
    ?>
    
</body>
</html>