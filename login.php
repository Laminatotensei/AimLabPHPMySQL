<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <?php

        try {
            
            // Conexion
            $base = new PDO("mysql:host=localhost; dbname=aimlabprueba", "root", "");
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Sentencia sql
            $sql = "SELECT * FROM USUARIOS WHERE NOMBRE = :login AND CONTRASENA = :password";
            $resultado = $base->prepare($sql);

            // Obetener los datos del INDEX
            $login = htmlentities(addslashes($_POST["login"]));
            $password = htmlentities(addslashes($_POST["password"]));

            // Comparacion y asignacion de la variables por metodo bindValue
            $resultado -> bindValue(":login", $login);
            $resultado -> bindValue(":password", $password);
            $resultado -> execute();

            // Contador de la cantidad de registros encontrados
            $numero_registro = $resultado->rowCount();

            if ($numero_registro != 0) {

                $registro = $resultado->fetch();
                $id = $registro['id'];

                // Guardo en mi sesion los datos del Nombre del usuario y su ID
                session_start();
                $_SESSION["usuario"] = $_POST["login"];
                $_SESSION["id"] = $id;
                header("location:bienvenido.php");

            }

            else {
                // Si no logro inicar sesion se regresa al INDEX
                header("location:index.php");
            }

        }

        catch(Exception $e) {

            // Error en la base de datos
            die ("Error: " . $e->getMessage());

        }

        // Cerrar mi base de datos
        $base = null;

    ?>

</body>
</html>