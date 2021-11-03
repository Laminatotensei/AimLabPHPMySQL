<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesion</title>

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
    
        try {

            session_start();

            if (!isset($_SESSION["usuario"])) {
                header("location:index.php");
            }

            // Id del usuario
            $id_u = $_SESSION['id'];

            $base = new PDO("mysql:host=localhost; dbname=aimlabprueba", "root", "");
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");

            $sql = "SELECT * FROM PERFIL_SPIDER WHERE ID_USUARIO = :id_u";
            $resultado = $base->prepare($sql);

            $resultado -> bindValue(":id_u", $id_u);
            $resultado -> execute();

            $registro = $resultado->fetch();

            // Id del perfil de sesion
            $id_perfil = $registro['id'];

            // Varaible del numero de vueltas
            $N_Vueltas = $_GET['n_vueltas'];
            $N_Vueltas_link = $_GET['n_vueltas'];

            if ($N_Vueltas != 0) {

                // Variable oculta que almacena la suma de los puntajes
                $suma_puntaje = $_POST['s_puntaje'];
                $suma_precision = $_POST['s_precision'];

                if ($N_Vueltas == 1) {

                    $puntaje = $_POST['puntaje'];
                    $precision = $_POST['precision'];
                    $id_perfil_juego_constante = $_POST['id_perfil_j'];

                    $suma_puntaje = $puntaje + $suma_puntaje;
                    $suma_precision = $precision + $suma_precision;

                    $sql = "INSERT INTO SESION_SPIDER (ID_USUARIO, ID_PERFIL_SPIDER, ID_PERFIL_JUEGO, N_VUELTAS, _PUNTAJE, _PRECISION, M_PUNTAJE, M_PRECISION, P_PUNTAJE, P_PRECISION)
                            VALUES (:id_u, :id_p, :id_p_j, :n_vueltas, :_puntaje, :_precision, :_puntaje, :_precision, :_puntaje, :_precision)";

                    $resultado = $base->prepare($sql); 
                    $resultado->execute(array(":id_u"=>$id_u,
                                              ":id_p"=>$id_perfil,
                                              ":id_p_j"=>$id_perfil_juego_constante,
                                              ":n_vueltas"=>$N_Vueltas,
                                              ":_puntaje"=>$puntaje,
                                              ":_precision"=>$precision));
                }

                else {

                    $puntaje = $_POST['puntaje'];
                    $precision = $_POST['precision'];

                    $N_Vueltas_temp = $N_Vueltas - 1;

                    $sql = "SELECT * FROM SESION_SPIDER WHERE ID_USUARIO = :id_u AND N_VUELTAS = :n_vueltas";

                    $resultado = $base->prepare($sql);
                    $resultado -> bindValue(":id_u", $id_u);
                    $resultado -> bindValue(":n_vueltas", $N_Vueltas_temp);
                    $resultado -> execute();

                    $registro = $resultado->fetch();

                    $suma_puntaje = $puntaje + $suma_puntaje;
                    $suma_precision = $precision + $suma_precision;

                    $promedio_puntaje = $suma_puntaje / $N_Vueltas;
                    $promedio_precision = $suma_precision / $N_Vueltas;

                    $M_Puntaje = $registro['M_Puntaje'];
                    $m_Precision = $registro['M_Precision'];

                    $id_perfil_juego_constante = $registro['id_perfil_juego'];

                    if ($puntaje > $M_Puntaje) {

                        $sql = "INSERT INTO SESION_SPIDER (ID_USUARIO, ID_PERFIL_SPIDER, ID_PERFIL_JUEGO, N_VUELTAS, _PUNTAJE, _PRECISION, M_PUNTAJE, M_PRECISION, P_PUNTAJE, P_PRECISION)
                                VALUES (:id_u, :id_p, :id_p_j, :n_vueltas, :_puntaje, :_precision, :_puntaje, :_precision, :p_puntaje, :p_precision)";

                        $resultado = $base->prepare($sql); 
                        $resultado->execute(array(":id_u"=>$id_u,
                                                  ":id_p"=>$id_perfil,
                                                  ":id_p_j"=>$id_perfil_juego_constante,
                                                  ":n_vueltas"=>$N_Vueltas,
                                                  ":_puntaje"=>$puntaje,
                                                  ":_precision"=>$precision,
                                                  ":p_puntaje"=>$promedio_puntaje,
                                                  ":p_precision"=>$promedio_precision));

                    }

                    else {

                        $sql = "INSERT INTO SESION_SPIDER (ID_USUARIO, ID_PERFIL_SPIDER, ID_PERFIL_JUEGO, N_VUELTAS, _PUNTAJE, _PRECISION, M_PUNTAJE, M_PRECISION, P_PUNTAJE, P_PRECISION)
                                VALUES (:id_u, :id_p, :id_p_j, :n_vueltas, :_puntaje, :_precision, :m_puntaje, :m_precision, :p_puntaje, :p_precision)";

                        $resultado = $base->prepare($sql); 
                        $resultado->execute(array(":id_u"=>$id_u,
                                                  ":id_p"=>$id_perfil,
                                                  ":id_p_j"=>$id_perfil_juego_constante,
                                                  ":n_vueltas"=>$N_Vueltas,
                                                  ":_puntaje"=>$puntaje,
                                                  ":_precision"=>$precision,
                                                  ":m_puntaje"=>$M_Puntaje,
                                                  ":m_precision"=>$m_Precision,
                                                  ":p_puntaje"=>$promedio_puntaje,
                                                  ":p_precision"=>$promedio_precision));

                    }

                }
            }

            else{
                
                $suma_puntaje = 0;
                $suma_precision = 0;

            }

            $N_Vueltas = $N_Vueltas + 1;

            echo "
            <form class='formulario' method='post' action='Sesion_Spider.php?n_vueltas=" . $N_Vueltas . "'>

                <img src='../logo.jpg'>
                <h1> Ingrese datos de la vuelta </h1>

                <div class='contenedor'>

                    <div class='input-contenedor'>
                        <i class='fas fa-sort-numeric-up-alt'></i>
                        <td><input type='number' placeholder='Puntaje' name='puntaje' id='puntaje' required></td>
                    </div>

                    <div class='input-contenedor'>
                        <i class='fas fa-sort-numeric-up-alt'></i>
                        <td><input type='number' placeholder='Precision' name='precision' id='precision' max=100 min=0 required></td>
                    </div>

                    <td><input type='text' class='oculta' value='" . $suma_puntaje . "' placeholder='s_puntaje' name='s_puntaje' id='s_puntaje' readonly></td>
                    <td><input type='text' class='oculta' value='" . $suma_precision . "' placeholder='s_precision' name='s_precision' id='s_precision' readonly></td>";

                    if ($N_Vueltas_link == 0) {

                        $id_perfil_juego = $_GET['id_p_j'];

                        echo "<td><input type='text' class='oculta' value='" . $id_perfil_juego . "' placeholder='id_perfil_j' name='id_perfil_j' id='id_perfil_j' readonly></td>";

                    }

                    echo "<td><input type='submit' name='nuevo' id='nuevo' value='Nuevo' class='button'></td><br><br>";

                    if ($N_Vueltas_link != 0){
                        
                        // Se le manda la variable Sesion = 2 porque estamos en Spidershot
                        echo "<a class='boton2' href='fin.php?sesion=2&u_vuelta=" . $N_Vueltas_link . "'> Volver </a>";

                    }

                    else {

                        echo "<a class='boton2' href='N_Sesion_Grid.php'> Volver </a>";

                    }

                "</div>

            </form>";

        } catch (Exception $e) {

            die ("Error: " . $e->getMessage());

        }

        $base = null;

    ?>

</body>
</html>