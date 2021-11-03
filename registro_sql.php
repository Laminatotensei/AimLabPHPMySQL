<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

    <?php
        // Variables de registro
        $nombre = $_GET ["n_usuario"];
        $correo = $_GET ["correo"];
        $contra = $_GET ["pass"];

        // Conexion
        require("datos_conexion.php");

        $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la BBDD";
            exit();
        }

        mysqli_select_db($conexion, $db_nombre) or die("No se encontro la BBDD");
        mysqli_set_charset($conexion, "utf8");

        // Registro
        $consulta = "INSERT INTO USUARIOS (NOMBRE, CORREO, CONTRASENA) VALUE ('$nombre', '$correo', '$contra')";
        $resultados = mysqli_query($conexion, $consulta);

        if ($resultados == false) {
            echo "Error en el registro";
        }

        else {
            echo "Resgistro guardado<br><br>";

            echo "<table>";
            echo "<tr><td>$nombre</td></tr>";
            echo "<tr><td>$correo</td></tr>";
            echo "<tr><td>$contra</td></tr>";
            echo "</table>";
        }

        mysqli_close($conexion);

        echo "<p>Tu cuenta está lista<a class='link' href='index.php'> Iniciar sesion</a></p>";
    
    ?>
    
</body>
</html>