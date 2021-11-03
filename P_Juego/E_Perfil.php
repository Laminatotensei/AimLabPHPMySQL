<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar perfil de juego</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/1382257960.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estilos.css">

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

        .oculta {
            opacity: 0;
            visibility: hidden;
            display: none;
            position: absolute;
            top: -9999px;
            width: 0;
            height: 0;
            margin: 0;
            padding: 0;
            border: 0;
            line-height: 0; /* sólo en caso de elementos inline-block */
            overflow: hidden;
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
            clip-path: polygon(1px 1px, 1px 1px, 1px 1px);
        }

    </style>
</head>
<body>

    <?php

        session_start();

        if (!isset($_SESSION["usuario"])) {
            header("location:index.php");
        }

        $id = $_GET['id'];

        try {

            $base = new PDO('mysql:host=localhost; dbname=aimlabprueba', 'root', '');
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");

            $sql = "SELECT NOMBRE, DPI, SENS, JUEGO FROM PERFIL_DE_JUEGO WHERE ID = :id";

            $resultado = $base->prepare($sql);
            $resultado->execute(array(":id" => $id));

            $registro = $resultado->fetch();
    
            echo "
            <form class='formulario' method='get' action='E_Perfil_SQL.php?'>

                <img src='../logo.jpg'>
                <h1> Edite los datos del perfil </h1>

                <div class='contenedor'>

                    <div class='input-contenedor'>
                        <i class='fas fa-file-signature'></i>
                        <td><input value='" . $registro['NOMBRE'] . "' type='text' placeholder='Nombre del perfil' name='n_perfil' id='n_perfil'></td>
                    </div>

                    <div class='input-contenedor'>
                        <i class='fas fa-mouse'></i>
                        <td><input value='" . $registro['DPI'] . "' type='number' placeholder='DPI' name='dpi' id='dpi' required></td>
                    </div>

                    <div class='input-contenedor'>
                        <i class='fas fa-sort-numeric-up-alt'></i>
                        <td><input value= '" . $registro['SENS'] . "' type='number' placeholder='Sensibilidad' name='sens' id='sens' step='0.001' required></td>
                    </div>

                    <div class='input-contenedor'>
                        <i class='fas fa-gamepad'></i>
                        <td><input type='text' value='" . $registro['JUEGO'] . "' placeholder='Juego' name='juego' id='juego' readonly></td>
                    </div>

                    <td><input type='text' class='oculta' value='" . $id . "' placeholder='id' name='id' id='id' readonly></td>

                    <td><input type='submit' name='editar' id='editar' value='Editar' class='button'></td><br><br>

                    <a class='boton2' href='V_Perfiles.php?'> Volver </a>

                </div>

            </form>";
        } catch(Exception $e) {

            die ('Error: ' . $e->getMessage());

        }

        $base = null;

    ?>

</body>
</html>