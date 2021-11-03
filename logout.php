<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <?php

        // Fin de la sesion
        session_start();
        session_destroy();

        header("location:index.php");

    ?>


</body>
</html>